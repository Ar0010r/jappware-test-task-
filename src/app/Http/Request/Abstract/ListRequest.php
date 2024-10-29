<?php 

namespace App\Http\Request\Abstract;

use App\Dto\Query\IDataRequest;
use App\Dto\Query\OrderBy;
use Illuminate\Validation\Rule;
use App\Dto\Query\OrderDirection;
use App\Dto\Query\PageRequest;
use Illuminate\Foundation\Http\FormRequest;

abstract class ListRequest extends FormRequest implements IDataRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
            'order_by' => 'nullable|string',
            'direction' => ['nullable', Rule::enum(OrderDirection::class)],
            'search_term' => 'nullable|string',
        ];
    }

    public function getPageRequest(): PageRequest
    {
        $page = $this->validated('page');
        $perPage = $this->validated('per_page');

        return new PageRequest($page, $perPage);
    }

    public function getOrderBy(): OrderBy
    {
        return new OrderBy(
            field: $this->validated('order_by'),
            direction: OrderDirection::tryFrom($this->validated('direction'))
        );
    }

    public function getSearchTerm(): ?string
    {
        return $this->validated('search_term');
    }

    public function getSelect(): array
    {
        return [];
    }
}