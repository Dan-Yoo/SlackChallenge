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

		$row = array(
			'player_1' 		=> $playerOne,
			'player_2' 		=> $playerTwo,
			'channel_id' 	=> $channelId,
			'turn' 			=> 1
		);

		pg_insert($connection, 'public.tictactoe', $row);

		echo "Tic-Tac-Toe game has begun!\n";
		echo $playerOne . " VS " . $playerTwo;
		echo "\n";
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

			$query 	= "SELECT * FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
			$result = pg_query($connection, $query);

			$row = pg_fetch_array($result, 0, PGSQL_ASSOC);
			
			//TODO create the display for the board
			//u can access each cell as shown below.
			echo $row['r1_c1'];

			echo "------------\n";
			echo "------------\n";

			return;
		}

		echo "There is currently no games being played in this channel!\n";
		return;
	}

	/**
	 * @return isWinning boolean that returns true if the move was a winning move
	 * @author d_yoo
	 */
	public function playMove($connection, $user, $channelId, $command)
	{
		// $query 	= "SELECT * FROM public.tictactoe WHERE channel_id = '" . $channelId . "'";
		// $result = pg_query($connection, $query);
		// $row 	= pg_fetch_array($result, 0, PGSQL_ASSOC);

		// //check if it actually is the users turn
		// if ($row['turn'] == 1) {
		// 	if ($user != $row['player_1']) {
		// 		echo "It isn't your turn to play!";
		// 		die;
		// 	}
		// } else {
		// 	if ($user != $row['player_2']) {
		// 		echo "It isn't your turn to play!";
		// 		die;
		// 	}
		// }

		echo "yay im getting this! \n";


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