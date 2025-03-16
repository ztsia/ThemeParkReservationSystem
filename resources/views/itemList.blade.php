<h1>Item List</h1>
<table>
  <tr>
    <th>id</th>
    <th>name</th>
    <th>normalPrice</th>
    <th>childrenSeniorPrice</th>
    <th>studentPrice</th>
    <th>Operation</th>
  </tr>
  @foreach($items as $item)
  <tr>
    <td>{{ $item['id'] }}</td>
    <td>{{ $item['name'] }}</td>
    <td>{{ $item['normalPrice'] }}</td>
    <td>{{ $item['childrenSeniorPrice'] }}</td>
    <td>{{ $item['studentPrice'] }}</td>
    <td><a href="addItemForm/{{ $item->id }}">Show Details</a></td>
  </tr>
  @endforeach
</table>