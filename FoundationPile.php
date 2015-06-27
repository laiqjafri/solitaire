<?php
class FoundationPile extends Pile {
    private $base_card = 5;

    public function __construct($max = 13, $circular = false, $fanned = false) {
        parent::__construct($max, $circular, $fanned);
        if(!$circular) {
            $this->base_card = 1;
        }
    }

    public function add_card($card) {
        if(count($this->get_cards()) == $this->max) {
            $this->user_message("Foundation Pile is full\n");
            return false;
        }
        if($this->is_empty()) {
            if($card->get_rank() == $this->base_card) {
                parent::add_card($card);
                return true;
            } else {
                $this->user_message("This pile should start with  " . $this->base_card . "\n");
                return false;
            }
        } else {
            $top_card = $this->get_top_card();
            if($top_card->get_suit() == $card->get_suit() and ((($top_card->get_rank() + 1) % 13) == ($card->get_rank() % 13))) {
                parent::add_card($card);
                return true;
            } else {
                $this->user_message("Illegal move\n");
                return false;
            }
        }
    }

    public function remove_card() {
        $this->user_message("Cannot remove card from foundation pile\n");
        return false;
    }

    public function can_donate_card_to($destination) {
        $this->user_message("Cannot remove a card from foundation pile\n");
        return false;
    }

    public function pile_name() {
        return "FoundationPile";
    }
}
?>
