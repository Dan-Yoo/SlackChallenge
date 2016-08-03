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

		// $row = array(
		// 	'player_1' 		=> $playerOne,
		// 	'player_2' 		=> $playerTwo,
		// 	'channel_id' 	=> $channelId,
		// 	'turn' 			=> 1
		// );

		// pg_insert($connection, 'public.tictactoe', $row);

		// echo "Tic-Tac-Toe game has begun!\n";
		// echo $playerOne . " VS " . $playerTwo;
		// echo "\n";
		echo HttpHelper::gameStartResponse($playerOne, $playerTwo);
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
			//echo "this is the current board. lol";

			$query 	= "SELECT * FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
			$result = pg_query($connection, $query);

			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);
			
			//TODO create the display for the board
			//u can access each cell as shown below.
			//echo $row['r1_c1'];

			//echo "------------\n";
			//echo "------------\n";

			return;
		}

		//echo "There is currently no games being played in this channel!\n";
		return;
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
				//echo "It isn't your turn to play!";
				die;
			}
		} else {
			$symbol = "O";
			$turn 	= 1;	

			if ($user != $row['player_2']) {
				//echo "It isn't your turn to play!";
				die;
			}
		}
		//validate their entry
		$inputRow	 = substr($command, 4, 1);
		$inputColumn = substr($command, 5, 1);
		$inputString = "r" . $inputRow . "_c" . $inputColumn;
		if (1 <= $inputRow && $inputRow <= 3 && 1 <= $inputColumn && $inputColumn <= 3) {
			//check if the coordinates is empty or not
			if (!empty($row[$inputString])) {
				//echo "Your opponent already played on this spot!\n";
				return;
			}

			//check if this will cause a winning move
			//$this->isWinning();

			//if not, just insert it into table.

			//insert into the table.
			$data 		= array('turn' => $turn, $inputString => $symbol);
			$condition 	= array('channel_id' => $channelId);
			$update 	= pg_update($connection, 'tictactoe', $data, $condition);

			//echo "inserted the players move into db. \n";

			//$this::displayBoard($connection, $channelId);

			return;
		}


		//echo "invalid input \n";

		//echo "yay im getting this! \n";


		//change the turn 

		//check if win


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