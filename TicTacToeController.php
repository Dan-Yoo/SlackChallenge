<?php

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

		$row1 		= array('column1' => '', 'column2' => '', 'column3' => '');
		$row2 		= array('column1' => '', 'column2' => '', 'column3' => '');
		$row3 		= array('column1' => '', 'column2' => '', 'column3' => '');
		$board 		= array('row1' => $row1,'row2' => $row2, 'row3' => $row3);
		$jsonBoard 	= json_encode($board);

		$row = array(
			'player_1' 		=> $playerOne,
			'player_2' 		=> $playerTwo,
			'channel_id' 	=> $channelId,
			'turn' 			=> 1,
			'board' 		=> $jsonBoard
		);

		pg_insert($connection, 'public.tictactoe', $row);

		echo "Tic-Tac-Toe game has begun!\n";
		echo $playerOne . " VS " . $playerTwo;
		echo "\n";
	}

	/**
	 * @param POST $data
	 * @return isWinning boolean that returns true if the move was a winning move
	 * @author d_yoo
	 */
	public function playMove($data)
	{
		//retrieve turn from table
		//if turn = $player
		
		//$move = explode(",", $data['text']);
		//$row = $move[0];
		//$column = $move[1];

		//insert that move into datatable

		//return isWinning($move);
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
			echo "this is the current board. lol";

			$query 	= "SELECT board FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
			$result = pg_query($connection, $query);
			$row 	= pg_fetch_array($result);

			$board = json_decode("'".$row[0]."'");

			$row1 = $board['row1'];
			$row2 = $board['row2'];
			$row3 = $board['row3'];

			echo $row1['column1'];

			return;
		}

		echo "There is currently no games being played in this channel!\n";
		return;
	}

	/**
	 * Method that removes the game from the datatable
	 *
	 * @param int $channelId
	 * @author d_yoo
	 */
	public function destroyTable($channelId)
	{
		//query to remove row of channelid given
	}
}

?>