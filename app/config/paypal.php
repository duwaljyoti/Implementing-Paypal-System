<?php
return array(
    // set your paypal credential




    'client_id' => 'ASgEssfX57Ekolb7vGnCVAc7YwG3zKQL6YqkkeTR4kBm7Hd-YTdRyymt58YVe1AXa_HYcMG9TuzPQLnZ',
    'secret' => 'EFdBuW5utHsge8m-LuzT7iZU9m4JZEbi6WiKCQh3NDRwZW9UBDYOFZkdg-CEqWQGjYHj-gC4idy3xVab',



    // saji
    
    // 'client_id'=>'ASFsTsAz9sxwTu9fYChgSFjMQfN6ddsjjhBe6I5VgDLGiuDRjeTO0q9GamgV7-rEwDzhnHSTvu3khcju',
    // 'secret'=>'EL-W8n7j1QeYZkcLBk-hKukNhb8VCo5Q624F9Qan6cAXwOxjNuM1fx1IJ4E7Y5RhHFUK-sLDWNwWl7Tt',


    //jeevan
    // 'client_id' => 'AfET2Vvtke2IRG3WU-GZZlrvBX1-pgXp7s-NiiUU6IeKV0Xnw3MDHuCOB0d8etb5hlpRaSsK5CX7pnSZ',
    // 'secret' => 'EBZhWVYgKT-Ha0eaNv1ckpVs9yB89hyPgGvKMWMqperINQ15D4d1TrDw6xCQDhkllGRYjZaGH8v5sISx',

    /**
     * SDK configuration
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE',
    ),
);



