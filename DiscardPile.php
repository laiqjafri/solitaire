<?php
class DiscardPile extends Pile {
    public function __construct() {
        parent::__construct(52, false, false);
    }

    public function can_donate_card_to($destination) {
        if($destination->pile_name() != "StockPile") {
            return true;
        } else {
            $this->user_message("Cannot move card from Discard Pile to Stock Pile\n");
            return false;
        }
    }

    public function pile_name() {
        return "DiscardPile";
    }

    public function print_pile($key = 0) {
        $cards_str_arr = array();
        foreach(array_reverse($this->get_cards()) as $index => $card) {
            if($index == 0) {
                $cards_str_arr []= (string) $card;
            } else {
                $cards_str_arr []= "up";
            }
        }
        $mask = "|[%-2s]|%-30s|{ %s }\n";
        printf($mask, $key, $this->pile_name(), implode(" , ", $cards_str_arr));
    }
}
?>
