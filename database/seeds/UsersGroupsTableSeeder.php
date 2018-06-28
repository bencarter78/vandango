<?php

use Illuminate\Database\Seeder;

class UsersGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users_groups')->delete();
        
        \DB::table('users_groups')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'group_id' => 1,
            ),
            1 => 
            array (
                'user_id' => 1,
                'group_id' => 2,
            ),
            2 => 
            array (
                'user_id' => 1,
                'group_id' => 9,
            ),
            3 => 
            array (
                'user_id' => 1,
                'group_id' => 11,
            ),
            4 => 
            array (
                'user_id' => 1,
                'group_id' => 12,
            ),
            5 => 
            array (
                'user_id' => 1,
                'group_id' => 13,
            ),
            6 => 
            array (
                'user_id' => 1,
                'group_id' => 14,
            ),
            7 => 
            array (
                'user_id' => 31,
                'group_id' => 1,
            ),
            8 => 
            array (
                'user_id' => 31,
                'group_id' => 2,
            ),
            9 => 
            array (
                'user_id' => 31,
                'group_id' => 6,
            ),
            10 => 
            array (
                'user_id' => 31,
                'group_id' => 9,
            ),
            11 => 
            array (
                'user_id' => 31,
                'group_id' => 20,
            ),
            12 => 
            array (
                'user_id' => 33,
                'group_id' => 1,
            ),
            13 => 
            array (
                'user_id' => 33,
                'group_id' => 2,
            ),
            14 => 
            array (
                'user_id' => 33,
                'group_id' => 5,
            ),
            15 => 
            array (
                'user_id' => 33,
                'group_id' => 6,
            ),
            16 => 
            array (
                'user_id' => 33,
                'group_id' => 10,
            ),
            17 => 
            array (
                'user_id' => 34,
                'group_id' => 1,
            ),
            18 => 
            array (
                'user_id' => 34,
                'group_id' => 4,
            ),
            19 => 
            array (
                'user_id' => 34,
                'group_id' => 5,
            ),
            20 => 
            array (
                'user_id' => 34,
                'group_id' => 8,
            ),
            21 => 
            array (
                'user_id' => 35,
                'group_id' => 1,
            ),
            22 => 
            array (
                'user_id' => 35,
                'group_id' => 3,
            ),
            23 => 
            array (
                'user_id' => 35,
                'group_id' => 5,
            ),
            24 => 
            array (
                'user_id' => 35,
                'group_id' => 8,
            ),
            25 => 
            array (
                'user_id' => 36,
                'group_id' => 1,
            ),
            26 => 
            array (
                'user_id' => 36,
                'group_id' => 2,
            ),
            27 => 
            array (
                'user_id' => 36,
                'group_id' => 4,
            ),
            28 => 
            array (
                'user_id' => 36,
                'group_id' => 5,
            ),
            29 => 
            array (
                'user_id' => 36,
                'group_id' => 8,
            ),
            30 => 
            array (
                'user_id' => 36,
                'group_id' => 9,
            ),
            31 => 
            array (
                'user_id' => 37,
                'group_id' => 1,
            ),
            32 => 
            array (
                'user_id' => 37,
                'group_id' => 4,
            ),
            33 => 
            array (
                'user_id' => 37,
                'group_id' => 5,
            ),
            34 => 
            array (
                'user_id' => 37,
                'group_id' => 8,
            ),
            35 => 
            array (
                'user_id' => 37,
                'group_id' => 9,
            ),
            36 => 
            array (
                'user_id' => 38,
                'group_id' => 1,
            ),
            37 => 
            array (
                'user_id' => 38,
                'group_id' => 3,
            ),
            38 => 
            array (
                'user_id' => 38,
                'group_id' => 5,
            ),
            39 => 
            array (
                'user_id' => 38,
                'group_id' => 8,
            ),
            40 => 
            array (
                'user_id' => 38,
                'group_id' => 9,
            ),
            41 => 
            array (
                'user_id' => 39,
                'group_id' => 1,
            ),
            42 => 
            array (
                'user_id' => 40,
                'group_id' => 1,
            ),
            43 => 
            array (
                'user_id' => 40,
                'group_id' => 2,
            ),
            44 => 
            array (
                'user_id' => 40,
                'group_id' => 4,
            ),
            45 => 
            array (
                'user_id' => 40,
                'group_id' => 5,
            ),
            46 => 
            array (
                'user_id' => 40,
                'group_id' => 6,
            ),
            47 => 
            array (
                'user_id' => 40,
                'group_id' => 8,
            ),
            48 => 
            array (
                'user_id' => 40,
                'group_id' => 10,
            ),
            49 => 
            array (
                'user_id' => 41,
                'group_id' => 1,
            ),
            50 => 
            array (
                'user_id' => 41,
                'group_id' => 9,
            ),
            51 => 
            array (
                'user_id' => 42,
                'group_id' => 1,
            ),
            52 => 
            array (
                'user_id' => 42,
                'group_id' => 8,
            ),
            53 => 
            array (
                'user_id' => 42,
                'group_id' => 12,
            ),
            54 => 
            array (
                'user_id' => 43,
                'group_id' => 1,
            ),
            55 => 
            array (
                'user_id' => 43,
                'group_id' => 2,
            ),
            56 => 
            array (
                'user_id' => 43,
                'group_id' => 9,
            ),
            57 => 
            array (
                'user_id' => 43,
                'group_id' => 14,
            ),
            58 => 
            array (
                'user_id' => 43,
                'group_id' => 15,
            ),
            59 => 
            array (
                'user_id' => 44,
                'group_id' => 1,
            ),
            60 => 
            array (
                'user_id' => 44,
                'group_id' => 4,
            ),
            61 => 
            array (
                'user_id' => 44,
                'group_id' => 5,
            ),
            62 => 
            array (
                'user_id' => 44,
                'group_id' => 8,
            ),
            63 => 
            array (
                'user_id' => 44,
                'group_id' => 12,
            ),
            64 => 
            array (
                'user_id' => 44,
                'group_id' => 14,
            ),
            65 => 
            array (
                'user_id' => 44,
                'group_id' => 16,
            ),
            66 => 
            array (
                'user_id' => 45,
                'group_id' => 1,
            ),
            67 => 
            array (
                'user_id' => 45,
                'group_id' => 4,
            ),
            68 => 
            array (
                'user_id' => 45,
                'group_id' => 5,
            ),
            69 => 
            array (
                'user_id' => 45,
                'group_id' => 8,
            ),
            70 => 
            array (
                'user_id' => 45,
                'group_id' => 14,
            ),
            71 => 
            array (
                'user_id' => 45,
                'group_id' => 16,
            ),
            72 => 
            array (
                'user_id' => 46,
                'group_id' => 1,
            ),
            73 => 
            array (
                'user_id' => 46,
                'group_id' => 8,
            ),
            74 => 
            array (
                'user_id' => 46,
                'group_id' => 14,
            ),
            75 => 
            array (
                'user_id' => 46,
                'group_id' => 16,
            ),
            76 => 
            array (
                'user_id' => 47,
                'group_id' => 1,
            ),
            77 => 
            array (
                'user_id' => 47,
                'group_id' => 4,
            ),
            78 => 
            array (
                'user_id' => 47,
                'group_id' => 5,
            ),
            79 => 
            array (
                'user_id' => 47,
                'group_id' => 8,
            ),
            80 => 
            array (
                'user_id' => 47,
                'group_id' => 14,
            ),
            81 => 
            array (
                'user_id' => 47,
                'group_id' => 16,
            ),
            82 => 
            array (
                'user_id' => 48,
                'group_id' => 1,
            ),
            83 => 
            array (
                'user_id' => 49,
                'group_id' => 1,
            ),
            84 => 
            array (
                'user_id' => 50,
                'group_id' => 1,
            ),
            85 => 
            array (
                'user_id' => 50,
                'group_id' => 8,
            ),
            86 => 
            array (
                'user_id' => 51,
                'group_id' => 1,
            ),
            87 => 
            array (
                'user_id' => 52,
                'group_id' => 1,
            ),
            88 => 
            array (
                'user_id' => 53,
                'group_id' => 1,
            ),
            89 => 
            array (
                'user_id' => 53,
                'group_id' => 4,
            ),
            90 => 
            array (
                'user_id' => 53,
                'group_id' => 5,
            ),
            91 => 
            array (
                'user_id' => 53,
                'group_id' => 8,
            ),
            92 => 
            array (
                'user_id' => 53,
                'group_id' => 14,
            ),
            93 => 
            array (
                'user_id' => 53,
                'group_id' => 16,
            ),
            94 => 
            array (
                'user_id' => 54,
                'group_id' => 1,
            ),
            95 => 
            array (
                'user_id' => 55,
                'group_id' => 1,
            ),
            96 => 
            array (
                'user_id' => 56,
                'group_id' => 1,
            ),
            97 => 
            array (
                'user_id' => 56,
                'group_id' => 8,
            ),
            98 => 
            array (
                'user_id' => 57,
                'group_id' => 1,
            ),
            99 => 
            array (
                'user_id' => 58,
                'group_id' => 1,
            ),
            100 => 
            array (
                'user_id' => 59,
                'group_id' => 1,
            ),
            101 => 
            array (
                'user_id' => 60,
                'group_id' => 1,
            ),
            102 => 
            array (
                'user_id' => 61,
                'group_id' => 1,
            ),
            103 => 
            array (
                'user_id' => 62,
                'group_id' => 1,
            ),
            104 => 
            array (
                'user_id' => 62,
                'group_id' => 12,
            ),
            105 => 
            array (
                'user_id' => 63,
                'group_id' => 1,
            ),
            106 => 
            array (
                'user_id' => 64,
                'group_id' => 1,
            ),
            107 => 
            array (
                'user_id' => 64,
                'group_id' => 8,
            ),
            108 => 
            array (
                'user_id' => 65,
                'group_id' => 1,
            ),
            109 => 
            array (
                'user_id' => 66,
                'group_id' => 1,
            ),
            110 => 
            array (
                'user_id' => 66,
                'group_id' => 2,
            ),
            111 => 
            array (
                'user_id' => 66,
                'group_id' => 9,
            ),
            112 => 
            array (
                'user_id' => 67,
                'group_id' => 1,
            ),
            113 => 
            array (
                'user_id' => 68,
                'group_id' => 1,
            ),
            114 => 
            array (
                'user_id' => 68,
                'group_id' => 9,
            ),
            115 => 
            array (
                'user_id' => 68,
                'group_id' => 12,
            ),
            116 => 
            array (
                'user_id' => 68,
                'group_id' => 13,
            ),
            117 => 
            array (
                'user_id' => 69,
                'group_id' => 1,
            ),
            118 => 
            array (
                'user_id' => 69,
                'group_id' => 9,
            ),
            119 => 
            array (
                'user_id' => 70,
                'group_id' => 12,
            ),
            120 => 
            array (
                'user_id' => 71,
                'group_id' => 1,
            ),
            121 => 
            array (
                'user_id' => 71,
                'group_id' => 12,
            ),
            122 => 
            array (
                'user_id' => 72,
                'group_id' => 1,
            ),
            123 => 
            array (
                'user_id' => 72,
                'group_id' => 12,
            ),
            124 => 
            array (
                'user_id' => 73,
                'group_id' => 1,
            ),
            125 => 
            array (
                'user_id' => 73,
                'group_id' => 12,
            ),
            126 => 
            array (
                'user_id' => 74,
                'group_id' => 12,
            ),
            127 => 
            array (
                'user_id' => 75,
                'group_id' => 12,
            ),
            128 => 
            array (
                'user_id' => 76,
                'group_id' => 1,
            ),
            129 => 
            array (
                'user_id' => 76,
                'group_id' => 5,
            ),
            130 => 
            array (
                'user_id' => 76,
                'group_id' => 8,
            ),
            131 => 
            array (
                'user_id' => 76,
                'group_id' => 12,
            ),
            132 => 
            array (
                'user_id' => 77,
                'group_id' => 12,
            ),
            133 => 
            array (
                'user_id' => 78,
                'group_id' => 1,
            ),
            134 => 
            array (
                'user_id' => 78,
                'group_id' => 8,
            ),
            135 => 
            array (
                'user_id' => 78,
                'group_id' => 12,
            ),
            136 => 
            array (
                'user_id' => 79,
                'group_id' => 12,
            ),
            137 => 
            array (
                'user_id' => 80,
                'group_id' => 1,
            ),
            138 => 
            array (
                'user_id' => 80,
                'group_id' => 8,
            ),
            139 => 
            array (
                'user_id' => 80,
                'group_id' => 12,
            ),
            140 => 
            array (
                'user_id' => 81,
                'group_id' => 1,
            ),
            141 => 
            array (
                'user_id' => 81,
                'group_id' => 8,
            ),
            142 => 
            array (
                'user_id' => 81,
                'group_id' => 12,
            ),
            143 => 
            array (
                'user_id' => 82,
                'group_id' => 12,
            ),
            144 => 
            array (
                'user_id' => 83,
                'group_id' => 1,
            ),
            145 => 
            array (
                'user_id' => 83,
                'group_id' => 8,
            ),
            146 => 
            array (
                'user_id' => 83,
                'group_id' => 12,
            ),
            147 => 
            array (
                'user_id' => 84,
                'group_id' => 12,
            ),
            148 => 
            array (
                'user_id' => 85,
                'group_id' => 12,
            ),
            149 => 
            array (
                'user_id' => 86,
                'group_id' => 1,
            ),
            150 => 
            array (
                'user_id' => 87,
                'group_id' => 1,
            ),
            151 => 
            array (
                'user_id' => 88,
                'group_id' => 1,
            ),
            152 => 
            array (
                'user_id' => 88,
                'group_id' => 2,
            ),
            153 => 
            array (
                'user_id' => 88,
                'group_id' => 12,
            ),
            154 => 
            array (
                'user_id' => 88,
                'group_id' => 13,
            ),
            155 => 
            array (
                'user_id' => 89,
                'group_id' => 1,
            ),
            156 => 
            array (
                'user_id' => 89,
                'group_id' => 12,
            ),
            157 => 
            array (
                'user_id' => 89,
                'group_id' => 13,
            ),
            158 => 
            array (
                'user_id' => 90,
                'group_id' => 1,
            ),
            159 => 
            array (
                'user_id' => 90,
                'group_id' => 4,
            ),
            160 => 
            array (
                'user_id' => 90,
                'group_id' => 5,
            ),
            161 => 
            array (
                'user_id' => 90,
                'group_id' => 6,
            ),
            162 => 
            array (
                'user_id' => 90,
                'group_id' => 9,
            ),
            163 => 
            array (
                'user_id' => 90,
                'group_id' => 10,
            ),
            164 => 
            array (
                'user_id' => 90,
                'group_id' => 12,
            ),
            165 => 
            array (
                'user_id' => 90,
                'group_id' => 13,
            ),
            166 => 
            array (
                'user_id' => 97,
                'group_id' => 14,
            ),
            167 => 
            array (
                'user_id' => 97,
                'group_id' => 16,
            ),
            168 => 
            array (
                'user_id' => 98,
                'group_id' => 14,
            ),
            169 => 
            array (
                'user_id' => 98,
                'group_id' => 16,
            ),
            170 => 
            array (
                'user_id' => 100,
                'group_id' => 4,
            ),
            171 => 
            array (
                'user_id' => 100,
                'group_id' => 9,
            ),
            172 => 
            array (
                'user_id' => 100,
                'group_id' => 14,
            ),
            173 => 
            array (
                'user_id' => 100,
                'group_id' => 15,
            ),
            174 => 
            array (
                'user_id' => 100,
                'group_id' => 19,
            ),
            175 => 
            array (
                'user_id' => 101,
                'group_id' => 14,
            ),
            176 => 
            array (
                'user_id' => 101,
                'group_id' => 16,
            ),
            177 => 
            array (
                'user_id' => 103,
                'group_id' => 20,
            ),
            178 => 
            array (
                'user_id' => 105,
                'group_id' => 14,
            ),
            179 => 
            array (
                'user_id' => 105,
                'group_id' => 16,
            ),
            180 => 
            array (
                'user_id' => 106,
                'group_id' => 1,
            ),
            181 => 
            array (
                'user_id' => 106,
                'group_id' => 4,
            ),
            182 => 
            array (
                'user_id' => 106,
                'group_id' => 9,
            ),
            183 => 
            array (
                'user_id' => 106,
                'group_id' => 14,
            ),
            184 => 
            array (
                'user_id' => 106,
                'group_id' => 15,
            ),
            185 => 
            array (
                'user_id' => 106,
                'group_id' => 19,
            ),
            186 => 
            array (
                'user_id' => 107,
                'group_id' => 1,
            ),
            187 => 
            array (
                'user_id' => 107,
                'group_id' => 8,
            ),
            188 => 
            array (
                'user_id' => 107,
                'group_id' => 14,
            ),
            189 => 
            array (
                'user_id' => 107,
                'group_id' => 19,
            ),
            190 => 
            array (
                'user_id' => 108,
                'group_id' => 14,
            ),
            191 => 
            array (
                'user_id' => 108,
                'group_id' => 19,
            ),
            192 => 
            array (
                'user_id' => 109,
                'group_id' => 14,
            ),
            193 => 
            array (
                'user_id' => 109,
                'group_id' => 19,
            ),
            194 => 
            array (
                'user_id' => 110,
                'group_id' => 14,
            ),
            195 => 
            array (
                'user_id' => 110,
                'group_id' => 19,
            ),
            196 => 
            array (
                'user_id' => 111,
                'group_id' => 1,
            ),
            197 => 
            array (
                'user_id' => 111,
                'group_id' => 4,
            ),
            198 => 
            array (
                'user_id' => 111,
                'group_id' => 5,
            ),
            199 => 
            array (
                'user_id' => 111,
                'group_id' => 8,
            ),
            200 => 
            array (
                'user_id' => 111,
                'group_id' => 14,
            ),
            201 => 
            array (
                'user_id' => 111,
                'group_id' => 16,
            ),
            202 => 
            array (
                'user_id' => 111,
                'group_id' => 19,
            ),
            203 => 
            array (
                'user_id' => 112,
                'group_id' => 14,
            ),
            204 => 
            array (
                'user_id' => 112,
                'group_id' => 15,
            ),
            205 => 
            array (
                'user_id' => 112,
                'group_id' => 19,
            ),
            206 => 
            array (
                'user_id' => 113,
                'group_id' => 14,
            ),
            207 => 
            array (
                'user_id' => 113,
                'group_id' => 19,
            ),
            208 => 
            array (
                'user_id' => 123,
                'group_id' => 17,
            ),
            209 => 
            array (
                'user_id' => 123,
                'group_id' => 18,
            ),
            210 => 
            array (
                'user_id' => 131,
                'group_id' => 1,
            ),
            211 => 
            array (
                'user_id' => 132,
                'group_id' => 1,
            ),
            212 => 
            array (
                'user_id' => 133,
                'group_id' => 1,
            ),
            213 => 
            array (
                'user_id' => 134,
                'group_id' => 1,
            ),
            214 => 
            array (
                'user_id' => 136,
                'group_id' => 1,
            ),
            215 => 
            array (
                'user_id' => 136,
                'group_id' => 14,
            ),
            216 => 
            array (
                'user_id' => 364,
                'group_id' => 1,
            ),
            217 => 
            array (
                'user_id' => 364,
                'group_id' => 8,
            ),
            218 => 
            array (
                'user_id' => 365,
                'group_id' => 1,
            ),
            219 => 
            array (
                'user_id' => 365,
                'group_id' => 8,
            ),
            220 => 
            array (
                'user_id' => 367,
                'group_id' => 1,
            ),
            221 => 
            array (
                'user_id' => 367,
                'group_id' => 8,
            ),
            222 => 
            array (
                'user_id' => 377,
                'group_id' => 1,
            ),
            223 => 
            array (
                'user_id' => 377,
                'group_id' => 8,
            ),
            224 => 
            array (
                'user_id' => 391,
                'group_id' => 1,
            ),
            225 => 
            array (
                'user_id' => 391,
                'group_id' => 4,
            ),
            226 => 
            array (
                'user_id' => 391,
                'group_id' => 8,
            ),
            227 => 
            array (
                'user_id' => 391,
                'group_id' => 14,
            ),
            228 => 
            array (
                'user_id' => 391,
                'group_id' => 16,
            ),
            229 => 
            array (
                'user_id' => 402,
                'group_id' => 1,
            ),
            230 => 
            array (
                'user_id' => 402,
                'group_id' => 8,
            ),
            231 => 
            array (
                'user_id' => 411,
                'group_id' => 1,
            ),
            232 => 
            array (
                'user_id' => 411,
                'group_id' => 8,
            ),
            233 => 
            array (
                'user_id' => 413,
                'group_id' => 1,
            ),
            234 => 
            array (
                'user_id' => 413,
                'group_id' => 8,
            ),
            235 => 
            array (
                'user_id' => 416,
                'group_id' => 1,
            ),
            236 => 
            array (
                'user_id' => 416,
                'group_id' => 8,
            ),
            237 => 
            array (
                'user_id' => 430,
                'group_id' => 14,
            ),
            238 => 
            array (
                'user_id' => 430,
                'group_id' => 16,
            ),
            239 => 
            array (
                'user_id' => 436,
                'group_id' => 1,
            ),
            240 => 
            array (
                'user_id' => 436,
                'group_id' => 8,
            ),
            241 => 
            array (
                'user_id' => 448,
                'group_id' => 1,
            ),
            242 => 
            array (
                'user_id' => 448,
                'group_id' => 8,
            ),
            243 => 
            array (
                'user_id' => 457,
                'group_id' => 14,
            ),
            244 => 
            array (
                'user_id' => 457,
                'group_id' => 15,
            ),
            245 => 
            array (
                'user_id' => 457,
                'group_id' => 19,
            ),
            246 => 
            array (
                'user_id' => 459,
                'group_id' => 1,
            ),
            247 => 
            array (
                'user_id' => 459,
                'group_id' => 5,
            ),
            248 => 
            array (
                'user_id' => 459,
                'group_id' => 8,
            ),
            249 => 
            array (
                'user_id' => 459,
                'group_id' => 14,
            ),
            250 => 
            array (
                'user_id' => 459,
                'group_id' => 16,
            ),
            251 => 
            array (
                'user_id' => 467,
                'group_id' => 1,
            ),
            252 => 
            array (
                'user_id' => 467,
                'group_id' => 5,
            ),
            253 => 
            array (
                'user_id' => 467,
                'group_id' => 8,
            ),
            254 => 
            array (
                'user_id' => 467,
                'group_id' => 16,
            ),
            255 => 
            array (
                'user_id' => 481,
                'group_id' => 1,
            ),
            256 => 
            array (
                'user_id' => 481,
                'group_id' => 2,
            ),
            257 => 
            array (
                'user_id' => 481,
                'group_id' => 9,
            ),
            258 => 
            array (
                'user_id' => 481,
                'group_id' => 11,
            ),
            259 => 
            array (
                'user_id' => 482,
                'group_id' => 17,
            ),
            260 => 
            array (
                'user_id' => 482,
                'group_id' => 18,
            ),
            261 => 
            array (
                'user_id' => 483,
                'group_id' => 1,
            ),
            262 => 
            array (
                'user_id' => 486,
                'group_id' => 1,
            ),
            263 => 
            array (
                'user_id' => 486,
                'group_id' => 8,
            ),
            264 => 
            array (
                'user_id' => 487,
                'group_id' => 1,
            ),
            265 => 
            array (
                'user_id' => 487,
                'group_id' => 8,
            ),
            266 => 
            array (
                'user_id' => 489,
                'group_id' => 1,
            ),
            267 => 
            array (
                'user_id' => 489,
                'group_id' => 8,
            ),
            268 => 
            array (
                'user_id' => 493,
                'group_id' => 1,
            ),
            269 => 
            array (
                'user_id' => 493,
                'group_id' => 8,
            ),
            270 => 
            array (
                'user_id' => 497,
                'group_id' => 1,
            ),
            271 => 
            array (
                'user_id' => 497,
                'group_id' => 8,
            ),
            272 => 
            array (
                'user_id' => 515,
                'group_id' => 1,
            ),
            273 => 
            array (
                'user_id' => 515,
                'group_id' => 14,
            ),
            274 => 
            array (
                'user_id' => 515,
                'group_id' => 19,
            ),
            275 => 
            array (
                'user_id' => 518,
                'group_id' => 1,
            ),
            276 => 
            array (
                'user_id' => 518,
                'group_id' => 8,
            ),
            277 => 
            array (
                'user_id' => 533,
                'group_id' => 1,
            ),
            278 => 
            array (
                'user_id' => 533,
                'group_id' => 8,
            ),
            279 => 
            array (
                'user_id' => 549,
                'group_id' => 1,
            ),
            280 => 
            array (
                'user_id' => 549,
                'group_id' => 8,
            ),
            281 => 
            array (
                'user_id' => 550,
                'group_id' => 1,
            ),
            282 => 
            array (
                'user_id' => 550,
                'group_id' => 8,
            ),
            283 => 
            array (
                'user_id' => 552,
                'group_id' => 1,
            ),
            284 => 
            array (
                'user_id' => 552,
                'group_id' => 8,
            ),
            285 => 
            array (
                'user_id' => 553,
                'group_id' => 1,
            ),
            286 => 
            array (
                'user_id' => 554,
                'group_id' => 1,
            ),
            287 => 
            array (
                'user_id' => 554,
                'group_id' => 8,
            ),
            288 => 
            array (
                'user_id' => 580,
                'group_id' => 1,
            ),
            289 => 
            array (
                'user_id' => 580,
                'group_id' => 5,
            ),
            290 => 
            array (
                'user_id' => 580,
                'group_id' => 8,
            ),
            291 => 
            array (
                'user_id' => 580,
                'group_id' => 14,
            ),
            292 => 
            array (
                'user_id' => 580,
                'group_id' => 16,
            ),
            293 => 
            array (
                'user_id' => 594,
                'group_id' => 14,
            ),
            294 => 
            array (
                'user_id' => 594,
                'group_id' => 19,
            ),
            295 => 
            array (
                'user_id' => 652,
                'group_id' => 2,
            ),
            296 => 
            array (
                'user_id' => 652,
                'group_id' => 17,
            ),
            297 => 
            array (
                'user_id' => 652,
                'group_id' => 18,
            ),
            298 => 
            array (
                'user_id' => 661,
                'group_id' => 1,
            ),
            299 => 
            array (
                'user_id' => 662,
                'group_id' => 1,
            ),
        ));
        
        
    }
}
