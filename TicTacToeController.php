<?php

include 'HttpHelper.php';

class TicTacToeController
{

	/**
	 * Verifies Slack token
	 *
	 * @param string $token
	 * @author d_yoo
	 */
	public function verifyToken($token)
	{
		if ($token != 'tywWH21kkZOVWWB7tGQLbbzc') {
			die("What are you doing here >:( I only accept requests from Slack!");
		}
	}

	/**
	 * Verifies if there is currently a game being played in given channel
	 *
	 * @param $connection
	 * @param $channelId
	 * @return boolean
	 * @author d_yoo
	 */
	public function verifyExistingGame($connection, $channelId)
	{
		$query = "SELECT * FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
		$result = pg_query($connection, $query);

		$row = pg_fetch_array($result);

		if (empty($row)) {
			return false;
		}

		return true;
	}

	/**
	 * Initializes a tic-tac-toe game for the channel
     *
	 * @param POST $data
	 * @author d_yoo
	 */
	public function initializeGame($connection, $playerOne, $playerTwo, $channelId)
	{
		//TODO::
		//validate that player 2 is indeed a user in the current channel

		$row = array(
			'player_1' 		=> $playerOne,
			'player_2' 		=> $playerTwo,
			'channel_id' 	=> $channelId,
			'turn' 			=> 1
		);

		pg_insert($connection, 'public.tictactoe', $row);

		// echo "Tic-Tac-Toe game has begun!\n";
		// echo $playerOne . " VS " . $playerTwo;
		// echo "\n";

		//D1X6BJKPS
		return HttpHelper::gameStartResponse($playerOne, $playerTwo);
	}

	/**
	 * @param array $move
	 * @return boolean 
	 * @author d_yoo
	 */
	public function isWinning($move)
	{
		//check database board
		//if win , echo out winning msg and remove row from table
		//if not, switch turn.
		return false;
	}

	/**
	 * 
     *
	 * @return string that is displayed for users to visualize the current board
	 * @author d_yoo
	 */
	public function displayBoard($connection, $channelId)
	{
		if ($this::verifyExistingGame($connection, $channelId)) {
			$query 	= "SELECT * FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
			$result = pg_query($connection, $query);

			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);
			

			return HttpHelper::displayResponse("This is the current board", $row, "good");
		}

		return HttpHelper::displayResponse("There is no game in this channel", null, "good");;
	}

	/**
	 * @return isWinning boolean that returns true if the move was a winning move
	 * @author d_yoo
	 */
	public function playMove($connection, $user, $channelId, $command)
	{
		$query 	= "SELECT * FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
		$result = pg_query($connection, $query);
		$row 	= pg_fetch_array($result, 0, PGSQL_ASSOC);

		//check if it actually is the users turn
		if ($row['turn'] == 1) {
			$symbol = "X";
			$turn 	= 2;

			if ($user != $row['player_1']) {
				return HttpHelper::genericResponse("It isn't your turn to play!");
			}
		} else {
			$symbol = "O";
			$turn 	= 1;	

			if ($user != $row['player_2']) {
				return HttpHelper::genericResponse("It isn't your turn to play!");
			}
		}
		//validate their entry
		$inputRow	 = substr($command, 4, 1);
		$inputColumn = substr($command, 5, 1);
		$inputString = "r" . $inputRow . "_c" . $inputColumn;

		if (1 <= $inputRow && $inputRow <= 3 && 1 <= $inputColumn && $inputColumn <= 3) {
			//check if the coordinates is empty or not
			if (!empty($row[$inputString])) {
				return HttpHelper::genericResponse("This spot was already played on!");
			}

			//check if this will cause a winning move
			//$this->isWinning();

			//insert into the table.
			$data 		= array('turn' => $turn, $inputString => $symbol);
			$condition 	= array('channel_id' => $channelId);
			$update 	= pg_update($connection, 'tictactoe', $data, $condition);

			$displayResult = pg_query($connection, $query);
			$displayRow    = pg_fetch_array($displayResult, 0, PGSQL_ASSOC);

			return HttpHelper::displayBoard("Good move!", $displayRow, "good");
		}
	}

	/**
	 * Method that removes the game from the datatable
	 *
	 * @param int $channelId
	 * @author d_yoo
	 */
	public function destroyBoard($channelId)
	{
		//query to remove row of channelid given
	}
}

?>