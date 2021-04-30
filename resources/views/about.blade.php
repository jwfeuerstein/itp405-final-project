@extends('layouts.main')

@section('title', 'About')

@section('content')
<br/>
<h6>What is the goal of this application?</h6>
<p>The goal of this application is to allow users to build, customize, and 
    compare NBA player lineups. Users will be able to select existing lineups 
    for current/past NBA teams or build their own lineups. Each lineup will 
    display data including combined points, rebounds, and assists per game, 
    average player efficiency rating, and average field goal percentage. For 
    example, the user could select the 2021 Brooklyn Nets and be taken to a 
    page that displays their starting lineup of Kyrie Irving, James Harden, 
    Kevin Durant, Blake Griffin, and DeAndre Jordan. The user can edit or delete 
    this lineup, or decide to create a brand new lineup by selecting a starting 
    five from the database of players. This new lineup will then have a page 
    similar to the one for existing lineups, where the user can see the players 
    and statistics while also having the option to edit or delete it.
</p>

<br />
<h6>Who should use this application?</h6>
<p>
    Fans lf the NBA should use this application. Specifically, it will be useful for
     NBA fans who are interested in data and statistics. It will allow them to explore 
     different player combinations to determine which lineups are most effective and 
     observe statistics related to their favorite teams and players.
</p>
@endsection