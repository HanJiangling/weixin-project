<?php

namespace App\Imports;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use App\Models\Job;


class CompanyJobImport implements ToCollection
{
    /**
     * 使用 ToCollection
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $rows)
    {
        // toArray($rows)
        // Job::create($rows);
        // dd($rows);
        $data=1;
        foreach ($rows as $row) 
        {
            $v=array();
            // var_dump($row);
            if($row[0]!=null){
                $v=array("name"=>$row[0],
                "phone"=>$row[1],
                "password"=>$row[2],
                );
            // var_dump($v);
             Job::create($v);

            
            }
            // return redirect("/adminjob")->with("success","批量导入成功");

             // Job::create($v);

        }
        return $data;

        // var_dump($rows);

        // CompanyUserModelDB::insert($data);
    }

    public function createData($rows)
    {
        //todo
        // var_dump($rows);
    }
}