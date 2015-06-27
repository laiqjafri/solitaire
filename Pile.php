<?php

abstract class Pile {
    protected $circular;
    protected $fanned;
    protected $max;
    protected $cards;
    public $show_user_message;

    public function __construct($max, $circular, $fanned) {
        $this->max      = $max;
        $this->circular = $circular;
        $this->fanned   = $fanned;
        $this->cards    = array();
        $this->show_user_message = true;
    }

    public function add_card($card) {
        $this->cards []= $card;
        return true;
    }

    public function remove_card() {
        array_pop($this->cards);
    }

    abstract public function can_donate_card_to($destination);
    abstract public function pile_name();

    protected function is_circular() {
        return $this->circular;
    }

    protected function is_fanned() {
        return $this->fanned;
    }

    public function get_top_card() {
        return end($this->cards);
    }

    public function print_pile($key = 0) {
        $cards_str_arr = array();
        foreach(array_reverse($this->get_cards()) as $index => $card) {
            if($this->is_fanned()) {
                $cards_str_arr []= (string) $card;
            } else {
                if($index == 0) {
                    $cards_str_arr []= (string) $card;
                } else {
                    $cards_str_arr []= "down";
                }
            }
        }
        $mask = "|[%-2s]|%-30s|{ %s }\n";
        printf($mask, $key, $this->pile_name(), implode(" , ", $cards_str_arr));
    }

    public function print_top_card() {
        echo $this->get_top_card();
    }

    public function get_cards() {
        return $this->cards;
    }

    public function is_empty() {
        return count($this->get_cards()) == 0;
    }

    public function deal_card($card) {
        $this->cards []= $card;
    }

    protected function user_message($message) {
        if($this->show_user_message) {
            echo $message;
        }
    }
}

?>
