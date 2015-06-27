<?php
include 'Autoloader.php';
class TowersTableauPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->pile = new TowersTableauPile();
        $this->pile->show_user_message = false;
    }

    public function test_card_donation() {
        $this->assertEquals(false, $this->pile->can_donate_card_to(new StockPile(), false));
        $this->assertEquals(false, $this->pile->can_donate_card_to(new DiscardPile(), false));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FortyThievesTableauPile(), false));
        $this->assertEquals(true, $this->pile->can_donate_card_to(new FoundationPile(), false));
    }

    public function test_name() {
        $this->assertEquals("TowersTableauPile", $this->pile->pile_name());
    }

    public function test_card_addtion() {
        $this->assertEquals(true, $this->pile->is_empty());
        $this->assertEquals(false, $this->pile->add_card(new Card("S", 10), false));
        $this->assertEquals(true, $this->pile->add_card(new Card("S", 13), false));
    }
}
?>
