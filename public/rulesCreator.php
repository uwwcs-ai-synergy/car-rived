<div class="page-header">
    <h1>Create some rules to search by</h1>
</div>

<form method="get" action="searchResults">
    <div class="input-group">
        <span class="input-group-addon">Make</span>
        <input type="text" class="form-control" placeholder="ex.volkswagen" name="make"/>
    </div>

    <div class="input-group">
        <span class="input-group-addon">Year</span>
        <input type="text" class="form-control" placeholder="ex.2000" name="year"/>
    </div>

    <div class="input-group">
        <span class="input-group-addon">Min Price</span>
        <input type="text" class="form-control" placeholder="ex.20000" name="minPrice"/>
    </div>

    <div class="input-group">
        <span class="input-group-addon">Max Price</span>
        <input type="text" class="form-control" placeholder="ex.30000" name="maxPrice"/>
    </div>

    <div>
        <button class="btn btn-primary" type="submit">Submit
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
        </button>
    </div>
</form>
