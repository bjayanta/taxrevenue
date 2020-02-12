<li class="nav-item {{ ($menu == 'home') ? 'active' : '' }}">
    <a href="{{ route('home') }}" class="nav-link">Home</a>
</li>

<li class="nav-item {{ ($menu == 'assessee') ? 'active' : '' }}">
    <a href="{{ route('assessee.index') }}" class="nav-link">Assessee List</a>
</li>

{{--
<li class="nav-item {{ ($menu == 'tax_return') ? 'active' : '' }}">
    <a href="{{ route('tax_return.index') }}" class="nav-link">Return Register</a>
</li>
--}}

<li class="nav-item {{ ($menu == 'report') ? 'active' : '' }} dropdown">
    <a id="reportDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Report
    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="reportDropdown">
        <a class="dropdown-item" href="{{ route('report.submited') }}">Submited</a>
        <a class="dropdown-item" href="{{ route('report.nonSubmited') }}">Non Submited</a>
    </div>
</li>

