<?php

class TicTacToeController
{
	/**
	 * Initializes a tic-tac-toe game for the channel
     *
	 * @param POST $data
	 * @author d_yoo
	 */
	public function initializeGame($data)
	{
		//$playerOne = $data['user_name'];
		//$playerTwo = $data['text'];
		//$channelId = $data['channel_id'];

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

CREATE TABLE tictactoe(
   ID INT PRIMARY KEY     NOT NULL,
   player_1       TEXT    NOT NULL,
   player_2       TEXT    NOT NULL,
   channel_id     INT     NOT NULL,
   turn			  INT     DEFAULT 1,
   board          jsonb    NOT NULL
);