<?php

namespace App\Http\Middleware;

use App\Models\Component;
use App\Models\ComponentHardware;
use App\Models\Consumable;
use App\Models\ConsumablePerson;
use App\Models\Contract;
use App\Models\CustomField;
use App\Models\CustomFieldValue;
use App\Models\Department;
use App\Models\Depreciation;
use App\Models\Hardware;
use App\Models\HardwareModel;
use App\Models\HardwarePerson;
use App\Models\HardwareStatus;
use App\Models\Licence;
use App\Models\LicencePerson;
use App\Models\Location;
use App\Models\Maintenance;
use App\Models\Manufacturer;
use App\Models\Person;
use App\Models\Supplier;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApplyTenantScopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Component::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        ComponentHardware::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Consumable::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        ConsumablePerson::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Contract::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        CustomField::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        CustomFieldValue::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Department::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Depreciation::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Hardware::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        HardwareModel::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        HardwarePerson::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        HardwareStatus::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Licence::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        LicencePerson::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Location::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Maintenance::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Manufacturer::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Person::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));
        Supplier::addGlobalScope(fn (Builder $query) => $query->whereBelongsTo(Filament::getTenant()));

        return $next($request);
    }
}
