<?php

require_once(ROOT_PATH . 'includes/classes/class.paypal.php');

class ShowPaypalPage extends AbstractPage
{
        const MAIL        = 'billing@makeyourgame.pro';

        public $pattern        = array(
                1        => '1.60',
                5        => '7.75',
                10       => '15.00',
                20       => '29.00',
                40       => '56.00',
                80       => '108.00',
        );
		
        public $cost        = '0';
        public $amount        = '0';

        function __construct() {
			parent::__construct();
			$action = HTTP::_GP('action', '');
            switch ($action){
				case 'success':
					$this->IPN();
				break;
				case 'cancel':
					$this->Cancel();
				break;
				case 'ipn':
					$this->IPN();
				break;
				default:
					$this->CallOrder();
				break;
			}
        }

        function CallOrder()
        {
			global $USER, $CONF, $UNI;

			$this->amount              = HTTP::_GP('amount',0);
			$this->cost                = HTTP::_GP('cost',0);

			if(!array_key_exists($this->amount, $this->pattern)) {
				$Mesage = "<span class='rouge'>".$LNG['NOUVEAUTE_22']."</span>";
			}

			$this->cost        = $this->pattern[$this->amount];
			$validationKey	= md5(uniqid('2m'));
			$GLOBALS['DATABASE']->query("INSERT INTO `uni1_paypal` (`id`, `player`, `amount`, `timestamp`, `price`) VALUES (NULL, '".$USER['id']."', '".$this->amount."', '".TIMESTAMP."', '".$this->cost."');");
			$this_p = new paypal_class;
			$ID        = $GLOBALS['DATABASE']->uniquequery("SELECT `id` FROM `uni1_paypal` WHERE `player` = '".$USER['id']."' AND `amount` = '".$this->amount."' AND `timestamp` = '".TIMESTAMP."'");
			$this_p->add_field('business', $this::MAIL);
			$this_p->add_field('return', 'https://'.$_SERVER['HTTP_HOST'].'/../../game.php?page=paypal&i='.$validationKey.'');
			$this_p->add_field('cancel_return', 'https://'.$_SERVER['HTTP_HOST'].'/../../ipn.php');
			$this_p->add_field('notify_url', 'https://'.$_SERVER['HTTP_HOST'].'/../../ipn.php');
				
			$this_p->add_field('item_name', $this->amount.' Credit-User('.$USER['username'].').');
			$this_p->add_field('item_number', $this->amount.'_credits');
			$this_p->add_field('amount', $this->cost);
			$this_p->add_field('currency_code', 'EUR');
			$this_p->add_field('custom', $USER['id'].','.$validationKey);
			$this_p->add_field('rm', '2');
			foreach ($this_p->fields as $name => $value) {
				$field[] = array('text'=>'<input type="hidden" name="'.$name.'" value="'.$value.'">');
			}
			$this->tplObj->assign_vars(array(
				'fields' => $field,
			));
			$this->display('paypal_class.tpl');
        }

}
?>