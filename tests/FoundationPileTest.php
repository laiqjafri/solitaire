<?php
include 'Autoloader.php';
class FoundationPileTest extends PHPUnit_Framework_TestCase {
    public function setup() {
        $this->nc_pile = new FoundationPile();//Non-circular pile
        $this->c_pile = new FoundationPile(13, true, false);//Non-circular pile
        $this->nc_pile->show_user_message = false;
        $this->c_pile->show_user_message = false;
    }

    public function test_card_donation() {
        //Cannot donate card
        $this->assertEquals(false, $this->nc_pile->can_donate_card_to(new FoundationPile()));
        $this->assertEquals(false, $this->nc_pile->can_donate_card_to(new FoundationPile()));
        $this->assertEquals(false, $this->nc_pile->can_donate_card_to(new SixteensTableauPile()));
        $this->assertEquals(false, $this->c_pile->can_donate_card_to(new FoundationPile()));
        $this->assertEquals(false, $this->c_pile->can_donate_card_to(new FoundationPile()));
        $this->assertEquals(false, $this->c_pile->can_donate_card_to(new SixteensTableauPile()));
    }

    public function test_name() {
        $this->assertEquals("FoundationPile", $this->nc_pile->pile_name());
        $this->assertEquals("FoundationPile", $this->c_pile->pile_name());
    }

    public function test_card_addtion() {
        //Non-circular
        $this->assertEquals(true, $this->nc_pile->is_empty());
        $this->assertEquals(false, $this->nc_pile->add_card(new Card("H", 5)));//Non-circular foundation pile should start with 1
        $this->assertEquals(true, $this->nc_pile->add_card(new Card("H", 1)));
        $this->assertEquals(false, $this->nc_pile->add_card(new Card("D", 1)));//Cannot add card of a different suit
        $this->assertEquals(false, $this->nc_pile->add_card(new Card("H", 3)));
        $this->assertEquals(true, $this->nc_pile->add_card(new Card("H", 2)));
        for($i=3; $i <= 13; $i++) {
            $this->assertEquals(true, $this->nc_pile->add_card(new Card("H", $i)));
        }
        $this->assertEquals(false, $this->nc_pile->add_card(new Card("H", 14)));//Cannot add more than 13 cards to a foundation pile

        //Circular
        $this->assertEquals(true, $this->c_pile->is_empty());
        $this->assertEquals(false, $this->c_pile->add_card(new Card("H", 1)));//Circular foundation pile should start with 5
        $this->assertEquals(true, $this->c_pile->add_card(new Card("H", 5)));
        $this->assertEquals(false, $this->c_pile->add_card(new Card("D", 6)));//Cannot add card of a different suit
        $this->assertEquals(false, $this->c_pile->add_card(new Card("H", 7)));
        $this->assertEquals(true, $this->c_pile->add_card(new Card("H", 6)));
        for($i=7; $i <= 17; $i++) {
            $this->assertEquals(true, $this->c_pile->add_card(new Card("H", $i % 13)));
        }
        $this->assertEquals(false, $this->c_pile->add_card(new Card("H", 5)));//Cannot add more than 13 cards to a foundation pile
    }
}
?>
