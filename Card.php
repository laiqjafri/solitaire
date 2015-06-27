<?php

class Card {
    private $suit;
    private $rank;
    public function __construct($suit, $rank) {
        $this->suit = $suit;
        $this->rank = $rank;
    }

    public function __toString() {
        return (string)$this->rank_str() . (string)$this->suit_str();
    }

    public function get_suit() {
        return $this->suit;
    }

    public function get_rank() {
        return $this->rank;
    }

    private function rank_str() {
        switch($this->rank) {
        case 1:
            return "A";
        case 11:
            return "J";
        case 12:
            return "Q";
        case 13:
            return "K";
        default:
            return (string)$this->rank;
        }
    }

    private function suit_str() {
        switch($this->suit) {
        case "H":
            return "❤️";
        case "D":
            return "♦️";
        case "C":
            return "♣️";
        case "S":
            return "♠️";
        }
    }

    public function color() {
        if($this->suit == "D" or $this->suit == "H") {
            return "red";
        } else {
            return "black";
        }
    }
}

?>
