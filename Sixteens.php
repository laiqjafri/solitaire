<?php
spl_autoload_register('autoload_func');
function autoload_func($class_name) {
    include $class_name.'.php';
}

class Sixteens extends Game {
    const TOTAL_SIXTEENS_TABLEAU_PILES = 16;
    const TOTAL_SPECIAL_TABLEAU_PILES  = 2;
    const INITIAL_SIXTEENS_TABLEAU_PILES_SIZE = 3;
    private $sixteens_tableau_piles;
    private $special_tableau_piles;

    public function __construct() {
        parent::__construct();
        $this->sixteens_tableau_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_SIXTEENS_TABLEAU_PILES; $i++) {
            $this->sixteens_tableau_piles []= new SixteensTableauPile();
        }

        $this->special_tableau_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_SPECIAL_TABLEAU_PILES; $i++) {
            $this->special_tableau_piles []= new SpecialTableauPile();
        }

        $this->foundation_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_FOUNDATION_PILES; $i++) {
            $this->foundation_piles []= new FoundationPile(self::MAX_CARDS_PER_FOUNDATION_PILE, true, false);
        }

        $this->deal_cards();
    }

    public function deal_cards() {
        $d = new Deck();

        $index = self::ZERO;
        while($card = $d->get_next_card()) {
            if($index < (self::TOTAL_SIXTEENS_TABLEAU_PILES * self::INITIAL_SIXTEENS_TABLEAU_PILES_SIZE)) {
                $this->sixteens_tableau_piles[$index % self::TOTAL_SIXTEENS_TABLEAU_PILES]->deal_card($card);
            } else {
                $this->special_tableau_piles[$index % self::TOTAL_SPECIAL_TABLEAU_PILES]->deal_card($card);
            }
            $index++;
        }

        foreach($this->foundation_piles as $index => $pile) {
            $this->piles []= $this->foundation_piles[$index];
        }

        foreach($this->sixteens_tableau_piles as $index => $pile) {
            $this->piles []= $this->sixteens_tableau_piles[$index];
        }

        foreach($this->special_tableau_piles as $index => $pile) {
            $this->piles []= $this->special_tableau_piles[$index];
        }

        $this->start_game();
    }
}

new Sixteens();
?>
