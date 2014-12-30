ALTER TABLE  `borrower` ADD  `note` TEXT NOT NULL AFTER  `adharno`

ALTER TABLE  `loan` ADD  `payoff_date` DATE NOT NULL AFTER  `start_date`

ALTER TABLE  `loan_transaction` ADD  `loan_amount` DOUBLE NOT NULL AFTER  `final_amount`

ALTER TABLE  `loan` ADD  `duration_in_month` INT NOT NULL AFTER  `installment_duration`

ALTER TABLE  `installment` ADD  `note` TEXT NOT NULL AFTER  `payoff`

ALTER TABLE  `loan` ADD  `loanname` VARCHAR( 100 ) NOT NULL AFTER  `status`

ALTER TABLE  `loan` CHANGE  `loanname`  `loanname` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL

/* query for display next week installments */
Select loan.loanname,borrower.firstname,borrower.lastname,
	(( IF(loan_transation.final_amount IS NULL,loan.amount,loan_transation.final_amount)*(loan.rate*12)/36500)*loan.installment_duration) as amount,
	date_add(installment.paid_date,INTERVAL loan.installment_duration DAY) as payment_date
	from loan 
left join borrower on loan.borrower_id=borrower.borrower_id
left join installment on loan.loan_id=installment.loan_id 
left join (select amount,loan_id,final_amount from (select * from loan_transaction order by lt_id desc) as transation group by transation.loan_id) as loan_transation on loan.loan_id=loan_transation.loan_id
where loan.status='1' 
and date_add(installment.paid_date,INTERVAL loan.installment_duration DAY) <  date_add(curdate(),INTERVAL 7 day) order by installment.paid_date