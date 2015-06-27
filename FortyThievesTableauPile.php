<?php
class FortyThievesTableauPile extends Pile {
    public function __construct() {
        parent::__construct(14, false, true);
    }

    public function add_card($card) {
        if($this->is_empty() or count($this->cards) == $this->max) {
            if($this->is_empty()) {
                if($this->pile_name() != "TowersTableauPile") {
                    parent::add_card($card);
                    return true;
                } else {
                    if($card->get_rank() == 13) {
                        parent::add_card($card);
                        return true;
                    } else {
                        $this->user_message("You can only add a K to an empty towers tableau pile\n");
                        return false;
                    }
                }
            } else {
                $this->user_message("The pile is full\n");
                return false;
            }
        } else {
            $top_card = $this->get_top_card();
            if($top_card->get_suit() == $card->get_suit() and (($top_card->get_rank() - 1) == $card->get_rank())) {
                parent::add_card($card);
                return true;
            } else {
                $this->user_message("Illegal move\n");
                return false;
            }
        }
    }

    public function can_donate_card_to($destination) {
        if($destination->pile_name() != "StockPile" and $destination->pile_name() != "DiscardPile") {
            return true;
        } else {
            $this->user_message("Cannot move card from FortyThievesTableauPile to StockPile or DiscardPile\n");
            return false;
        }
    }

    public function pile_name() {
        return "FortyThievesTableauPile";
    }
}
?>
