<?php
class TowersTableauPile extends FortyThievesTableauPile {
    public function __construct() {
        parent::__construct(17, false, true);
    }

    public function pile_name() {
        return "TowersTableauPile";
    }
}
?>
