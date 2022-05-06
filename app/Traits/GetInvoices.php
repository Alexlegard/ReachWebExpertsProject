<?php

namespace App\Traits;

use Auth;
use App\Admin;
use Carbon\Carbon;

trait GetInvoices {

	// Return count of today's invoices
	public function getTodaysInvoices(Admin $admin) {
		
		$invoices = $admin->invoices;
		$count = 0;
		
		foreach($invoices as $invoice) {

			$invoiceTimeIssued = Carbon::parse($invoice->time_issued);

			if($invoiceTimeIssued->isToday() ) {
				$count++;
			}
		}

		return $count;
	}

	// Return array of integers of this week's invoices
	public function getWeeklyInvoices(Admin $admin) {

		// 0 is Monday, 1 is Tuesday, etc.
		$invoices_array = [
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
			6 => 0,
			7 => 0,
		];

		$invoices = $admin->invoices;
		$startOfWeek = Carbon::now()->startOfWeek();
		$endOfWeek = Carbon::now()->endOfWeek();

		foreach($invoices as $invoice) {

			$invoiceWasIssued = Carbon::parse($invoice->time_issued);

			if($invoiceWasIssued->between($startOfWeek, $endOfWeek) ) {

				$invoices_array[ $invoiceWasIssued->dayOfWeek ] += 1;
			}
		}
		return $invoices_array;
	}

	// Return array of integers of this month's invoices
	public function getMonthlyInvoices(Admin $admin) {

		$invoices_array = [];
		$invoices = $admin->invoices;
		$now = Carbon::now();
		$startOfMonth = $now->startOfMonth();

		for($i = 1; $i <= $now->daysInMonth; $i++) {
			$invoices_array[$i] = 0;
		}

		foreach( $invoices as $invoice ) {

			$invoiceWasIssued = Carbon::parse($invoice->time_issued);

			if($invoiceWasIssued->between($startOfMonth, Carbon::now())) {

				$day = Carbon::parse($invoice->time_issued)->day;
				$invoices_array[$day] += 1;
			}
		}
		
		return $invoices_array;
	}
	
	// Return array of integers of this quarter's invoices
	public function getQuarterlyInvoices(Admin $admin) {

		$invoices = $admin->invoices;
		$now = Carbon::now();
		$startOfQuarter = $now->startOfQuarter(); // October 1
		$endOfQuarter = $now->startOfQuarter(); // December 

		$invoices_array = [
			1 => 0,
			2 => 0,
			3 => 0, // Each quarter has three months
		];

		foreach( $invoices as $invoice ) {

			$invoiceWasIssued = Carbon::parse($invoice->time_issued);

			// This resolves to false for some reason.
			if($invoiceWasIssued->between($startOfQuarter, Carbon::now())) {

				$month = Carbon::parse($invoice->time_issued)->month;

				// 1st month of quarter
				if( $month % 3 == 1 ) {
					$invoices_array[1] += 1;
				}

				// 2nd month of quarter
				if( $month % 3 == 2 ) {
					$invoices_array[2] += 1;
				}

				// 3rd month of quarter
				if( $month % 3 == 0) {
					$invoices_array[3] += 1;
				}
			}
		}

		return $invoices_array;
	}

	// Return dollar amount made today
	public function getTodaysRevenue(Admin $admin) {

		$invoices = $admin->invoices;
		$revenue = 0;
		
		foreach($invoices as $invoice) {

			$invoiceTimeIssued = Carbon::parse($invoice->time_issued);

			if($invoiceTimeIssued->isToday() ) {
				
				$revenue += $invoice->subtotal;
			}
		}

		return $revenue;
	}

	// Return array of dollar amounts made this week
	public function getWeeklyRevenue(Admin $admin) {

		// 0 is Monday, 1 is Tuesday, etc.
		$revenue_array = [
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
			6 => 0,
			7 => 0,
		];

		$invoices = $admin->invoices;
		$startOfWeek = Carbon::now()->startOfWeek();
		$endOfWeek = Carbon::now()->endOfWeek();

		foreach($invoices as $invoice) {

			$invoiceWasIssued = Carbon::parse($invoice->time_issued);

			if($invoiceWasIssued->between($startOfWeek, $endOfWeek) ) {

				$revenue_array[ $invoiceWasIssued->dayOfWeek ] += $invoice->subtotal;
			}
		}

		return $revenue_array;
	}

	// Return array of dollar amounts made this month
	public function getMonthlyRevenue(Admin $admin) {

		$revenue_array = [];
		$invoices = $admin->invoices;
		$now = Carbon::now();
		$startOfMonth = $now->startOfMonth();

		for($i = 1; $i <= $now->daysInMonth; $i++) {
			$revenue_array[$i] = 0;
		}

		foreach( $invoices as $invoice ) {

			$invoiceWasIssued = Carbon::parse($invoice->time_issued);

			if($invoiceWasIssued->between($startOfMonth, Carbon::now())) {

				$day = Carbon::parse($invoice->time_issued)->day;
				$revenue_array[$day] += $invoice->subtotal;
			}
		}
		
		return $revenue_array;
	}

	// Return array of dollar amounts made this quarter
	public function getQuarterlyRevenue(Admin $admin) {

		$invoices = $admin->invoices;
		$now = Carbon::now();
		$startOfQuarter = $now->startOfQuarter(); // October 1
		$endOfQuarter = $now->startOfQuarter(); // December 

		$revenue_array = [
			1 => 0,
			2 => 0,
			3 => 0, // Each quarter has three months
		];

		foreach( $invoices as $invoice ) {

			$invoiceWasIssued = Carbon::parse($invoice->time_issued);

			// This resolves to false for some reason.
			if($invoiceWasIssued->between($startOfQuarter, Carbon::now())) {

				$month = Carbon::parse($invoice->time_issued)->month;

				// 1st month of quarter
				if( $month % 3 == 1 ) {
					$revenue_array[1] += $invoice->subtotal;
				}

				// 2nd month of quarter
				if( $month % 3 == 2 ) {
					$revenue_array[2] += $invoice->subtotal;
				}

				// 3rd month of quarter
				if( $month % 3 == 0) {
					$revenue_array[3] += $invoice->subtotal;
				}
			}
		}

		return $revenue_array;
	}
}