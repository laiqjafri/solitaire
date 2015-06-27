<?php
spl_autoload_register('autoload_func');
function autoload_func($class_name) {
    include $class_name.'.php';
}

class FortyThieves extends Game {
    const TOTAL_FORTY_THIEVES_TABLEAU_PILES = 10;
    const INITIAL_FORTY_THIEVES_TABLEAU_PILES_SIZE = 2;
    private $forty_thieves_tableau_piles;
    private $stock_piles;
    private $discard_piles;

    public function __construct() {
        parent::__construct();
        $this->forty_thieves_tableau_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_FORTY_THIEVES_TABLEAU_PILES; $i++) {
            $this->forty_thieves_tableau_piles []= new FortyThievesTableauPile();
        }

        $this->foundation_piles = array();
        for($i = self::ZERO; $i < self::TOTAL_FOUNDATION_PILES; $i++) {
            $this->foundation_piles []= new FoundationPile(self::MAX_CARDS_PER_FOUNDATION_PILE, false, false);
        }

        $this->stock_pile = new StockPile();

        $this->discard_pile = new DiscardPile();

        $this->piles = array();
        $this->deal_cards();
    }

    public function deal_cards() {
        $d = new Deck();

        $index = self::ZERO;
        while($card = $d->get_next_card()) {
            if($index < (self::TOTAL_FORTY_THIEVES_TABLEAU_PILES * self::INITIAL_FORTY_THIEVES_TABLEAU_PILES_SIZE)) {
                $this->forty_thieves_tableau_piles[$index % self::TOTAL_FORTY_THIEVES_TABLEAU_PILES]->deal_card($card);
            } else {
                $this->stock_pile->deal_card($card);
            }
            $index++;
        }

        foreach($this->foundation_piles as $index => $pile) {
            $this->piles []= $this->foundation_piles[$index];
        }

        foreach($this->forty_thieves_tableau_piles as $index => $pile) {
            $this->piles []= $this->forty_thieves_tableau_piles[$index];
        }

        $this->piles []= $this->stock_pile;
        $this->piles []= $this->discard_pile;

        $this->start_game();
    }
}

new FortyThieves();
?>
