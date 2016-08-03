<?php

class HttpHelper
{
	/**
	 * Response when game is intialized
	 *
	 * @param string $playerOne
	 * @param string $playerTwo
	 * @return json object
	 * @author d_yoo
	 */
	public function gameStartResponse($playerOne, $playerTwo)
	{
		$message = "A new game has begun!\n" . $playerOne . " VS " . $playerTwo; 

		$response = array(
			"response_type" => "in_channel",
			"text" 			=> $message
		);

		return json_encode($response);
	}

	/**
	 * Response when the display command is received
	 *
	 * @param string $message
	 * @param array $data represents the data from db
	 * @param string $color represents the status 
	 * @return json object
	 * @author d_yoo
	 */
	public function displayResponse($message, $data, $color = "good")
	{
		// $turn = $data['turn'];
		// $text = "this is my text";
		// $color = "good";
		// $row1 = "X O O"; 
		// $row2 = "X O X";
		// $row3 = "O X O";

		// $row1 = $data['r1_c1']." ".$data['r1_c2']." ".$data['r1_c3'];
		// $row2 = $data['r2_c1']." ".$data['r2_c2']." ".$data['r2_c3'];
		// $row3 = $data['r3_c1']." ".$data['r3_c2']." ".$data['r3_c3'];

		// $board = array(
		// 	0 => array("title" => $row1), 
		// 	1 => array("title" => $row2),
		// 	2 => array("title" => $row3),
		// );

		// $response = array(
		// 	"response_type" => "in_channel",
		// 	"text" 			=> $message,
		// 	"attachments" 	=> array(
		// 		"fields" => $board,
		// 		"color"  => $color
		// 	)
		// );

		$response = array(
			"response_type" => "in_channel",
			"text" 			=> "testing success"
		);

		return json_encode($response);
	}


	/**
	 * Response for game winning move
	 *
	 * @param string $winner
	 * @return json response
	 * @author d_yoo
	 */
	public function winnerResponse($winner)
	{
		$message = "Game has ended! /n Winner is " . $winner;

		$response = array(
			"response_type" => "in_channel",
			"text" 			=> $message
		);

		return json_encode($response);
	}

	/**
	 * Given the board, checks if the move caused a winning move
	 *
	 * @param array $board row date from the db table
	 * @param string $rowPlayed
	 * @param string $columnPlayed
	 * @param char $symbol
	 */
	public function isWinning($board, $rowPlayed, $columnPlayed, $symbol)
	{
		$symbol = 'X';
        $rowPlayed = 3;
        $columnPlayed = 1;

        $board = array(
            "r1_c1" => "",
            "r1_c2" => "",
            "r1_c3" => "",
            "r2_c1" => "",
            "r2_c2" => "X",
            "r2_c3" => "",
            "r3_c1" => "",
            "r3_c2" => "",
            "r3_c3" => "X"
        );

        if ($board["r" . $rowPlayed . "_c1"] == $symbol &&
            $board["r" . $rowPlayed . "_c2"] == $symbol &&
            $board["r" . $rowPlayed . "_c3"] == $symbol) {
            dd("winning row");
            return true;
        }

        if ($board["r1_c" . $columnPlayed] == $symbol &&
            $board["r2_c" . $columnPlayed] == $symbol &&
            $board["r3_c" . $columnPlayed] == $symbol) {
            dd("winning column");
            return true;
        }

        //check diagonals if coordinates were 
        // 11 13 31 33 22
        if (($rowPlayed != 2 && $columnPlayed != 2) || ($rowPlayed == 2 && $columnPlayed == 2)) {
            if ($board['r1_c1'] == $symbol &&
                $board['r2_c2'] == $symbol &&
                $board['r3_c3'] == $symbol ) {
                dd('winning diagonal 1');
                return true;
            }

            if ($board['r1_c3'] == $symbol &&
                $board['r2_c2'] == $symbol &&
                $board['r3_c1'] == $symbol ) {
                dd('winning diagonal 2');
                return true;
            }
        }

        dd("not winning move");
        return false;
	}
}

?>