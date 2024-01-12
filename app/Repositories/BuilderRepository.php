<?php

namespace App\Repositories;

use App\DTO\BuilderRequestDTO;
use App\DTO\BuilderResponseDTO;
use App\Models\{Builder, BuilderSubGroup};

class BuilderRepository implements IBuilderRepository
{
    public function create(BuilderRequestDTO $builderRequestDTO): BuilderResponseDTO
    {
        try {
            $builder = Builder::create($builderRequestDTO->toArray());
            foreach ($builderRequestDTO->sub_group_name as $group_name) {
                if(!empty($group_name)){
                    $subGroupName = new BuilderSubGroup;
                    $subGroupName->builder_id = $builder->id;
                    $subGroupName->name = $group_name;
                    $subGroupName->save();
                }
            }
            return new BuilderResponseDTO($builder);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }
    
    public function update(int $id, BuilderRequestDTO $builderRequestDTO): BuilderResponseDTO
    {
        try {
            $builder = Builder::findOrFail($id);
            if(!empty($builder->group_logo)){
                $builderRequestDTO->group_logo = $builder->group_logo;
            }
            // unset($builderRequestDTO['group_logo']);
            $builder->update($builderRequestDTO->toArray());
            foreach ($builderRequestDTO->sub_group_name as $key=>$group_name) {
                if(!empty($group_name)){
                    if(isset($builderRequestDTO->sub_group[$key])){
                    
                        $subGroup = BuilderSubGroup::find($builderRequestDTO->sub_group[$key]);
                        $subGroup->builder_id = $builder->id;
                        $subGroup->name = $group_name;
                        $subGroup->save();
                    }else{
                        $subGroupName = new BuilderSubGroup;
                        $subGroupName->builder_id = $builder->id;
                        $subGroupName->name = $group_name;
                        $subGroupName->save();
                    }
                }
            }
            return new BuilderResponseDTO($builder);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
        
    }

    public function saveCompanyLogo(int $id, $file_name)
    {
        try {
            $builderFile = Builder::find($id);
            $builderFile->group_logo = $file_name;
            $builderFile->save();
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                exception_logging($e);
            }
        }
       
    }
    
}



