<?php

namespace App\Imports;

use App\Unstable;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UnstablesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {   
            if ( $this->checkPrimaryKeyRecord($row['coil_id']) ) {
                continue;
            } 

            $unstable = Unstable::create([
                // 'id'          => $row['id'],
                'line'        => $row['line'       ],
                'start_date'  => $row['start_date' ],
                'shift'       => $row['shift'      ],
                'duty'        => $row['duty'       ],
                'area'        => $row['area'       ],
                'catego'      => $row['catego'     ],
                'steel_grade' => $row['steel_grade'],
                'coil_id'     => $row['coil_id'    ],
                'aim_thick'   => $row['aim_thick'  ],
                'aim_width'   => $row['aim_width'  ],
                'events'      => $row['events'     ],
                'describe'    => $row['describe'   ],
            ]);

        }
    }

    public function checkPrimaryKeyRecord(string $coilId) 
    {
        if (Unstable::where('coil_id', '=', $coilId)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}