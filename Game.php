<?php
abstract class Game {
    const ZERO = 0;
    const TOTAL_FOUNDATION_PILES = 4;
    const MAX_CARDS_PER_FOUNDATION_PILE = 13;
    protected $foundation_piles;
    protected $piles;

    public function __construct() {
        $this->piles = array();
    }
    abstract public function deal_cards();

    protected function has_ended() {
        foreach($this->foundation_piles as $foundation_pile) {
            if(count($foundation_pile->get_cards()) < self::MAX_CARDS_PER_FOUNDATION_PILE) {
                return false;
            }
        }

        return true;
    }

    public function get_next_move() {
        echo "Enter src# dest# ('quit' to end game): ";
        $handle = fopen ("php://stdin","r");
        $move = fgets($handle);
        $move = explode(" ", preg_replace('/\s+/', ' ', trim($move)));
        return $move;
    }

    public function redraw_board() {
        foreach($this->piles as $key => $pile) {
            $pile->print_pile($key);
        }
    }

    protected function start_game() {
        $draw_board = true;
        while(!$this->has_ended()) {
            if($draw_board) {
                $this->redraw_board();
            }
            $move = $this->get_next_move();
            if(count($move) and count($move) == 2 and is_numeric($move[0]) and is_numeric($move[1]) and $move[0] >= self::ZERO and $move[1] < count($this->piles)) {
                $source      = &$this->piles[$move[0]];
                $destination = &$this->piles[$move[1]];
                $card = $source->get_top_card();

                if(!$source->is_empty() and $source->can_donate_card_to($destination) and $destination->add_card($card)) {
                    $source->remove_card();
                    $draw_board = true; //Redraw the board only if the move was successful
                } else {
                    $draw_board = false;
                }
            } else if($move[0] == "quit") {
                echo "Game Ended\n";
                return;
            }else {
                echo "Not a valid move. Please enter according to the required format\n";
                $draw_board = false;
            }
        }
        echo "\n\nYOU WON!!!\n\n";
    }
}
?>
