<form id="search_form" action="/" onsubmit="removeEmptyFields()">
    @method('GET')
    <div class="flex space-x-2 mb-4 w-full">
        <input id="date_from-filter" type="text" placeholder="Date from" name="date_from"
            value="{{ isset($filters['date_from']) ? $filters['date_from'] : '' }}"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <input name="date_to" value="{{ isset($filters['date_to']) ? $filters['date_to'] : '' }}" id="date_to-filter"
            type="text" placeholder="Date to"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <input name="amount_from" value="{{ isset($filters['amount_from']) ? $filters['amount_from'] : '' }}"
            type="text" placeholder="Min. amount" placeholder="Filter by Date/Time"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <input name="amount_to" value="{{ isset($filters['amount_to']) ? $filters['amount_to'] : '' }}" type="text"
            placeholder="Max amount" placeholder="Filter by Date/Time"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <input name="player_name" value="{{ isset($filters['player_name']) ? $filters['player_name'] : '' }}"
            type="text" placeholder="Player name" placeholder="Filter by Date/Time"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <input name="player_ids" value="{{ isset($filters['player_ids']) ? $filters['player_ids'] : '' }}" type="text"
            placeholder="Payer ids" placeholder="Filter by Date/Time"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
    </div>
    <div class="flex space-x-2 mb-4 w-full">
        <select name="order_by"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <option value="">Order By</option>
            <option value="id" {{ isset($filters['order_by']) && $filters['order_by'] == 'id' ? 'selected' : '' }}>Date
            </option>
            <option value="amount" {{ isset($filters['order_by']) && $filters['order_by'] == 'amount' ? 'selected' : '' }}>Amount</option>
            <option value="player_id" {{ isset($filters['order_by']) && $filters['order_by'] == 'player_id' ? 'selected' : '' }}>Player Id</option>
            <option value="player.name" {{ isset($filters['order_by']) && $filters['order_by'] == 'player.name' ? 'selected' : '' }}>Name</option>
            <option value="player.email" {{ isset($filters['order_by']) && $filters['order_by'] == 'player.email' ? 'selected' : '' }}>Email</option>
            <option value="player.phone" {{ isset($filters['order_by']) && $filters['order_by'] == 'player.phone' ? 'selected' : '' }}>Phone</option>
        </select>
        <select name="direction"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <option value="">Direction</option>
            <option value="asc" {{ isset($filters['direction']) && $filters['direction'] == 'asc' ? 'selected' : '' }}>
                Ascending</option>
            <option value="desc" {{ isset($filters['direction']) && $filters['direction'] == 'desc' ? 'selected' : '' }}>
                Descending</option>
        </select>
        <input name="search_term" type="text" placeholder="Search Term"
            value="{{ isset($filters['search_term']) ? $filters['search_term'] : '' }}"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
        <select name="per_page"
            class="flex-1 min-w-0 w-full p-2 border rounded-md bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400">
            <option value=20 {{ isset($filters['per_page']) && $filters['per_page'] == 20 ? 'selected' : '' }}>20</option>
            <option value=30 {{ isset($filters['per_page']) && $filters['per_page'] == 30 ? 'selected' : '' }}>30</option>
            <option value=50 {{ isset($filters['per_page']) && $filters['per_page'] == 50 ? 'selected' : '' }}>50</option>
        </select>

        <button type="submit"
            class="flex-1 min-w-0 w-full p-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none">Search</button>
        <button type="button" onclick="resetFilters()"
            class="flex-1 min-w-0 w-full p-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-600 focus:outline-none">Cancel</button>
    </div>
</form>


<script>
        function removeEmptyFields() {
            const form = document.getElementById('search_form');
            let inputs = form.querySelectorAll('input');

            inputs.forEach(input => {
                if (input.value === '') {
                    input.removeAttribute('name');
                }
            });

            inputs = form.querySelectorAll('select');

            inputs.forEach(input => {
                if (input.value === '') {
                    input.removeAttribute('name');
                }
            });
        }
    </script>

    <script>
        function resetFilters() {
            const form = document.getElementById('search_form');

            let one_week_ago = new Date();
            console.log(one_week_ago);
            one_week_ago.setDate(one_week_ago.getDate() - 6);
            one_week_ago.setHours(0, 0, 0, 0);
            one_week_ago = one_week_ago.toISOString().slice(0, 10) + ' 00:00';

            let tomorrow_midnight = new Date();
            tomorrow_midnight.setDate(tomorrow_midnight.getDate() + 2);
            tomorrow_midnight.setHours(0, 0, 0, 0);
            tomorrow_midnight = tomorrow_midnight.toISOString().slice(0, 10) + ' 00:00';

            form.querySelectorAll('input').forEach(input => {
                if (input.id === 'date_from-filter') {
                    input.value = one_week_ago;
                } else if (input.id === 'date_to-filter') {
                    input.value = tomorrow_midnight;
                } else {
                    input.value = '';
                }
            });

            form.querySelectorAll('select').forEach(select => {
                select.selectedIndex = '';
            });

            document.getElementById('deposits-table').style.display = 'none';
        }
    </script>