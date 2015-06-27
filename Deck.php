<?php
class Deck {
    private $cards;

    public function __construct($shuffle = true) {
        $this->cards = array();
        $suits = array("C", "D", "H", "S");
        $ranks = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);

        foreach($suits as $suit) {
            foreach($ranks as $rank) {
                $this->cards []= new Card($suit, $rank);
            }
        }

        if($shuffle) {
            $this->shuffle();
        }
    }

    public function shuffle() {
        shuffle($this->cards);
    }

    public function get_next_card() {
        if(count($this->cards)) {
            return array_pop($this->cards);
        }
    }

    public function length() {
        return count($this->cards);
    }

    public function is_empty() {
        return $this->length();
    }
}

?>
