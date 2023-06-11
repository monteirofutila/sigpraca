<?php

namespace App\Services;

use App\DTO\Markets\MarketDTO;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ServerException;
use App\Helpers\FunctionHelper;
use App\Repositories\MarketRepository;
use Illuminate\Support\Facades\DB;

class MarketService
{
    public function __construct(
        protected MarketRepository $repository,
    ) {
    }

    public function getFirst(): ?object
    {
        return $this->repository->getFirst();
    }

    public function update(MarketDTO $dto): ?object
    {

        throw_if(!auth()->user()->can('markets-update'), new ForbiddenException);

        DB::beginTransaction();

        try {

            $market = $this->repository->getFirst();
            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'markets');
                $dto->photo = $image_path;
                if ($market->photo) {
                    FunctionHelper::deletePhoto($market->photo);
                }
            }

            $market = $this->repository->update(
                id: $market->id,
                data: $dto->toArray()
            );

            DB::commit();

            return $market;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

}