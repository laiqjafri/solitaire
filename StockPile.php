<?php
class StockPile extends Pile {
    public function __construct() {
        parent::__construct(52, false, false);
    }

    public function add_card($card) {
        $this->user_message("Stock pile does not accept cards");
        return false;
    }

    public function can_donate_card_to($destination) {
        return $destination->pile_name() == "DiscardPile";
    }

    public function pile_name() {
        return "StockPile";
    }

    public function print_pile($key = 0) {
        $cards_str_arr = array();
        foreach(array_reverse($this->get_cards()) as $card) {
            $cards_str_arr []= "down";
        }
        $mask = "|[%-2s]|%-30s|{ %s }\n";
        printf($mask, $key, $this->pile_name(), implode(" , ", $cards_str_arr));
    }
}
?>
