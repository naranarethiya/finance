ALTER TABLE  `borrower` ADD  `note` TEXT NOT NULL AFTER  `adharno`

ALTER TABLE  `loan` ADD  `payoff_date` DATE NOT NULL AFTER  `start_date`