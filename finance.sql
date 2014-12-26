-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2014 at 08:05 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrower`
--

CREATE TABLE IF NOT EXISTS `borrower` (
  `borrower_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `drivinglic` varchar(25) NOT NULL,
  `adharno` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`borrower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `installment`
--

CREATE TABLE IF NOT EXISTS `installment` (
  `insta_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `pay_amount` double NOT NULL,
  `paid_amount` double NOT NULL,
  `paid_date` date NOT NULL,
  `payoff` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`insta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `installment`
--
DROP TRIGGER IF EXISTS `AI_loan_txn`;
DELIMITER //
CREATE TRIGGER `AI_loan_txn` AFTER INSERT ON `installment`
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
		
		INSERT INTO `loan_transaction`(`loan_id`, `borrower_id`, `insta_id`, `amount`, `final_amount`, `reason`) VALUES (NEW.loan_id,NEW.borrower_id,NEW.insta_id,NEW.paid_amount,final_amount,payoff);
	
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
		INSERT INTO `loan_transaction`(`loan_id`, `borrower_id`, `insta_id`, `amount`, `final_amount`, `reason`) VALUES (NEW.loan_id,NEW.borrower_id,NEW.insta_id,NEW.paid_amount,final_amount,payoff);
		update loan set `status`=0 where loan_id = NEW.loan_id; 		
		ELSE
		INSERT INTO `loan_transaction`(`loan_id`, `borrower_id`, `insta_id`, `amount`, `final_amount`, `reason`) VALUES (NEW.loan_id,NEW.borrower_id,NEW.insta_id,NEW.paid_amount,final_amount,payoff);
		END IF;
	END IF;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `loan`
--

CREATE TABLE IF NOT EXISTS `loan` (
  `loan_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrower_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `rate` float NOT NULL,
  `start_date` date NOT NULL,
  `installment_duration` int(11) NOT NULL,
  `note` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`loan_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `loan_transaction`
--

CREATE TABLE IF NOT EXISTS `loan_transaction` (
  `lt_id` int(11) NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL,
  `borrower_id` int(11) NOT NULL,
  `insta_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `final_amount` double NOT NULL,
  `reason` varchar(100) NOT NULL,
  PRIMARY KEY (`lt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE IF NOT EXISTS `login_history` (
  `uid` int(11) NOT NULL,
  `login_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `username`, `password`) VALUES
(1, 'abc', 'abc@email.com', 'abc123');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
