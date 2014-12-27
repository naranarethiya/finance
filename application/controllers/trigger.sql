DELIMITER $$
CREATE TRIGGER AI_loan_txn AFTER INSERT ON installment 
FOR EACH ROW BEGIN
	DECLARE pay_amount DOUBLE(8,2) DEFAULT 0;
	DECLARE paid_amount DOUBLE(8,2) DEFAULT 0;
	DECLARE loan_amount DOUBLE(8,2) DEFAULT 0;
	DECLARE final_amount DOUBLE(8,2) DEFAULT 0;
	DECLARE user_amount DOUBLE(8,2) DEFAULT 0;
	DECLARE payoff VARCHAR(25);
	
	select amount from loan where `loan_id`=NEW.loan_id
	into loan_amount;	
	
	SET pay_amount=NEW.pay_amount;
	SET paid_amount=NEW.paid_amount;

	IF(pay_amount > paid_amount) THEN
		SET payoff="Installment";
		SET final_amount=loan_amount+(pay_amount-paid_amount);
		
		INSERT INTO `loan_transaction`(`loan_id`, `borrower_id`, `insta_id`, `amount`, `final_amount`, `loan_amount`, `reason`) VALUES (NEW.loan_id,NEW.borrower_id,NEW.insta_id,NEW.paid_amount,final_amount,loan_amount,payoff);
	
	ELSEIF(pay_amount <= paid_amount) THEN
		SET user_amount=pay_amount;

		IF(user_amount = paid_amount  && NEW.payoff = "1") THEN
			SET payoff="Payoff";
			SET final_amount=0;
		ELSE
			SET payoff="Installment";
			SET final_amount=loan_amount-(paid_amount-pay_amount);
	    END IF;
		IF(payoff = "Payoff") THEN
		INSERT INTO `loan_transaction`(`loan_id`, `borrower_id`, `insta_id`, `amount`, `final_amount`, `loan_amount`, `reason`) VALUES (NEW.loan_id,NEW.borrower_id,NEW.insta_id,NEW.paid_amount,final_amount,loan_amount,payoff);
		update loan set `status`=0 where loan_id = NEW.loan_id; 		
		ELSE
		INSERT INTO `loan_transaction`(`loan_id`, `borrower_id`, `insta_id`, `amount`, `final_amount`, `loan_amount`, `reason`) VALUES (NEW.loan_id,NEW.borrower_id,NEW.insta_id,NEW.paid_amount,final_amount,loan_amount,payoff);
		END IF;
	END IF;
END $$
DELIMITER ;