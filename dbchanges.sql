ALTER TABLE  `borrower` ADD  `note` TEXT NOT NULL AFTER  `adharno`

ALTER TABLE  `loan` ADD  `payoff_date` DATE NOT NULL AFTER  `start_date`

ALTER TABLE  `loan_transaction` ADD  `loan_amount` DOUBLE NOT NULL AFTER  `final_amount`

ALTER TABLE  `loan` ADD  `duration_in_month` INT NOT NULL AFTER  `installment_duration`

ALTER TABLE  `installment` ADD  `note` TEXT NOT NULL AFTER  `payoff`

ALTER TABLE  `loan` ADD  `loanname` VARCHAR( 100 ) NOT NULL AFTER  `status`