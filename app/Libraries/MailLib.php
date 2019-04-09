<?php

namespace App\Libraries;

class MailLib {

    public static function is_valid_email($email) {
        if (eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
            return true;
        } else {
            return false;
        }
    } 
    
    public static function generateWOCode() { 
        $year = date('Y');
        $month = MailLib::getRoman();
        $preffix = "WO" . $month . $year;

        $work_orders = \App\Models\WorkOrder::orderBy('id', 'desc')
                ->take(50)
                ->get();
        $max_seq = 1;
        if ($work_orders->count() < 1) {
            $seq = '000001';
        } else {
            $sequences = array();
            foreach ($work_orders as $work_order) {
                $code = $work_order->code;
                $splited_code = explode('_', $code);
                if (array_key_exists(1, $splited_code)) {
                    $tail = substr($splited_code[1], -6, 6);
                    $sequences[] = $tail;
                }
            }

            $max_seq = max($sequences);
            $seq = sprintf('%06s', $max_seq + 1);
        }

        $code = MailLib::generateLastWOCode($preffix, $seq);
        
        return $code;
    }
    
    public static function generateLastWOCode($preffix,$seq) {
        $code = $preffix . '_' . $seq;
        $las_code = \App\Models\WorkOrder::where('code', $code)->first();
        if ($las_code) {
            $seq = sprintf('%06s', $seq + 1);
            $code = $preffix . '_' . $seq;
        } 

        return $code;
    }
    
    public static function generatePOCode() { 
        $year = date('Y');
        $month = MailLib::getRoman();
        $preffix = "PO" . $month . $year;

        $work_orders = \App\Models\WorkOrder::orderBy('id', 'desc')
                ->take(50)
                ->get();
        $max_seq = 1;
        if ($work_orders->count() < 1) {
            $seq = '000001';
        } else {
            $sequences = array();
            foreach ($work_orders as $work_order) {
                $code = $work_order->code;
                $splited_code = explode('_', $code);
                if (array_key_exists(1, $splited_code)) {
                    $tail = substr($splited_code[1], -6, 6);
                    $sequences[] = $tail;
                }
            }

            $max_seq = max($sequences);
            $seq = sprintf('%06s', $max_seq + 1);
        }

        $code = MailLib::generateLastPOCode($preffix, $seq);
        
        return $code;
    }
    
    public static function generateLastPOCode($preffix,$seq) {
        $code = $preffix . '_' . $seq;
        $las_code = \App\Models\PurchaseOrder::where('code', $code)->first();
        if ($las_code) {
            $seq = sprintf('%06s', $seq + 1);
            $code = $preffix . '_' . $seq;
        } 

        return $code;
    }
    
    public static function generateTransactioCode() { 
        $year = date('Y');
        $month = MailLib::getRoman();
        $preffix = "PO" . $month . $year;

        $work_orders = \App\Models\Transaction::orderBy('id', 'desc')
                ->take(50)
                ->get();
        $max_seq = 1;
        if ($work_orders->count() < 1) {
            $seq = '000001';
        } else {
            $sequences = array();
            foreach ($work_orders as $work_order) {
                $code = $work_order->code;
                $splited_code = explode('_', $code);
                if (array_key_exists(1, $splited_code)) {
                    $tail = substr($splited_code[1], -6, 6);
                    $sequences[] = $tail;
                }
            }

            $max_seq = max($sequences);
            $seq = sprintf('%06s', $max_seq + 1);
        }

        $code = MailLib::generateLastTransactionCode($preffix, $seq);
        
        return $code;
    }
    
    public static function generateLastTransactionCode($preffix,$seq) {
        $code = $preffix . '_' . $seq;
        $las_code = \App\Models\Transaction::where('code', $code)->first();
        if ($las_code) {
            $seq = sprintf('%06s', $seq + 1);
            $code = $preffix . '_' . $seq;
        } 

        return $code;
    }
    
    protected static function getRoman() {
        $months = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII',
        ];
        return $months[date('n')];
    }


}
