<?php
spl_autoload_register('autoload_func');
function autoload_func($class_name) {
    include $class_name.'.php';
}

class Towers extends Game {
    const TOTAL_TOWERS_TABLEAU_PILES = 10;
    const TOTAL_SPECIAL_TOWERS_PILES = 4;
    const INITIAL_TOWERS_TABLEAU_PILES_SIZE = 5;
    private $towers_tableau_piles;
    private $special_towers_piles;

    public function __construct() {
        parent::__construct();
        $this->towers_tableau_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_TOWERS_TABLEAU_PILES; $i++) {
            $this->towers_tableau_piles []= new TowersTableauPile();
        }

        $this->special_towers_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_SPECIAL_TOWERS_PILES; $i++) {
            $this->special_towers_piles []= new SpecialTowersPile();
        }

        $this->foundation_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_FOUNDATION_PILES; $i++) {
            $this->foundation_piles []= new FoundationPile(self::MAX_CARDS_PER_FOUNDATION_PILE, false, false);
        }

        $this->piles = array();
        $this->deal_cards();
    }

    public function deal_cards() {
        $d = new Deck();

        $index = self::ZERO;
        while($card = $d->get_next_card()) {
            if($index < (self::TOTAL_TOWERS_TABLEAU_PILES * self::INITIAL_TOWERS_TABLEAU_PILES_SIZE)) {
                $this->towers_tableau_piles[$index % self::TOTAL_TOWERS_TABLEAU_PILES]->deal_card($card);
            } else {
                $this->special_towers_piles[$index % (self::TOTAL_SPECIAL_TOWERS_PILES / 2)]->deal_card($card);
            }
            $index++;
        }

        foreach($this->foundation_piles as $index => $pile) {
            $this->piles []= $this->foundation_piles[$index];
        }

        foreach($this->towers_tableau_piles as $index => $pile) {
            $this->piles []= $this->towers_tableau_piles[$index];
        }

        foreach($this->special_towers_piles as $index => $pile) {
            $this->piles []= $this->special_towers_piles[$index];
        }

        $this->start_game();
    }
}

new Towers();
?>
