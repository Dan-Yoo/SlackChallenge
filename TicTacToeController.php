<?php

class TicTacToeController
{
	public function verifyToken($token)
	{
		if ($token != 'tywWH21kkZOVWWB7tGQLbbzc') {
			die("What are you doing here >:( I only accept requests from Slack!");
		}
	}

	public function verifyExistingGame($connection, $channelId)
	{
		$query = "SELECT * FROM public.tictactoe WHERE channel_id = " . $channelId;
		$result = pg_query($connection, $query);

		$row = pg_fetch_row($result);

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
		//$query = "INSERT INTO public.tictactoe (player_1, player_2, channel_id) VALUES (".$playerOne.",".$playerTwo.",".$channelId.")";
		$array = array(
			'player_1' => 'KINGDDD123',
			'player_2' => 'TRALALALALA',
			'channel_id' => 1236,
			'turn' => 1,
			'board' => '{}'
		);
		pg_insert($connection, 'public.tictactoe', $array);
		
		//$playerOne = $data['user_name'];
		//$playerTwo = $data['text'];
		//$channelId = $data['channel_id'];

		echo "game has been initialized!";
		//INSERT INTO table 
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
	public function displayBoard()
	{
		//retrieve rows from table, display it, nicely formatted.
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