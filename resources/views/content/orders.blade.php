@extends('layouts/contentLayoutMaster')

@section('title', 'Orders')

@push('styles')
<style>
.find_field[type=text], select.find_field {
    width: 100%;
    padding: 1px 2px;
    font-size: 13px;
    height: 25px;
    vertical-align: middle;
    min-width: 50px;
    font-weight: normal;
} 

.tbl-servers th, .tbl-servers td {
    vertical-align: middle!important;
    text-align: center;
}  
.tr-bg-active {
    background-color: grey!important;
}
</style>
@endpush

@section('content')
<!-- Kick start -->

<div class="card">
  <div class="card-header">
    <h4 class="card-title">Order Prov Details</h4>
  </div>
  <div class="card-body">
    {{ $orders->links('paginate.index') }}
    
    Count: {{ $orders_count }}
  
<table class="table">
  <thead>
    <tr>
      <th scope="col"><input value="{{ urldecode(request('search.OrderId')) }}" name="search[OrderId]" onchange="changeFindField(this)" class="find_field" type="text" /></th>
      <th scope="col"><input value="{{ urldecode(request('search.IpEngStatus')) }}" name="search[IpEngStatus]" onchange="changeFindField(this)" class="find_field" type="text" /></th>
      <th scope="col"><input value="{{ urldecode(request('search.StatusCode')) }}" name="search[StatusCode]" onchange="changeFindField(this)" class="find_field" type="text" /></th>
      <th scope="col"><input value="{{ urldecode(request('search.OrderCreatedDt')) }}" name="search[OrderCreatedDt]" onchange="changeFindField(this)" class="find_field" type="text" /></th>
      <th scope="col"><input value="{{ urldecode(request('search.CustCutOverDt')) }}" name="search[CustCutOverDt]" onchange="changeFindField(this)" class="find_field" type="text" /></th>
      <th scope="col"><input value="{{ urldecode(request('search.IPENGNotes')) }}" name="search[IPENGNotes]" onchange="changeFindField(this)" class="find_field" type="text" /></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <thead>
    <tr>
      <th scope="col"><a onclick="changeSortField(this)" href="" data-name="sort" data-value="{{ $sort == 'OrderId' ? '-' : '' }}OrderId">OrderId</a></th>
      <th scope="col"><a onclick="changeSortField(this)" href="" data-name="sort" data-value="{{ $sort == 'IpEngStatus' ? '-' : '' }}IpEngStatus">IpEngStatus</a></th>
      <th scope="col"><a onclick="changeSortField(this)" href="" data-name="sort" data-value="{{ $sort == 'StatusCode' ? '-' : '' }}StatusCode">StatusCode</a></th>
      <th scope="col"><a onclick="changeSortField(this)" href="" data-name="sort" data-value="{{ $sort == 'OrderCreatedDt' ? '-' : '' }}OrderCreatedDt">OrderCreatedDt</a></th>
      <th scope="col"><a onclick="changeSortField(this)" href="" data-name="sort" data-value="{{ $sort == 'CustCutOverDt' ? '-' : '' }}CustCutOverDt">CustCutOverDt</a></th>
      <th scope="col"><a onclick="changeSortField(this)" href="" data-name="sort" data-value="{{ $sort == 'IPENGNotes' ? '-' : '' }}IPENGNotes">IPENGNotes</a></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <td><a style="white-space: nowrap;" href="{{ route('orders.detail', ['order_id' => $order->OrderId]) }}">{{ $order->OrderId }}</a></td>
      <td>{{ $order->IpEngStatus }}</td>
      <td>{{ $order->StatusCode }}</td>
      <td>{{ $order->OrderCreatedDt }}</td>
      <td>{{ $order->CustCutOverDt }}</td>
      <td>{{ $order->IPENGNotes }}</td>
      <td><a href="{{ route('orders.detail', ['order_id' => $order->OrderId]) }}"><i data-feather="arrow-up-right"></i></a></td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $orders->links('paginate.index') }}
  </div>
</div>
<!--/ Kick start -->
@endsection

@push('scripts')
<script>
function changeFindField (obj) {
    event.preventDefault();
    if (event.stopPropagation) {
        event.stopPropagation()
    } else {
        event.cancelBubble = true
    }
    
    changeGetValueByPage($(obj).attr('name'), $(obj).val());
    
    return false;
}

function changeSortField (obj) {
    event.preventDefault();
    if (event.stopPropagation) {
        event.stopPropagation()
    } else {
        event.cancelBubble = true
    }
    
    changeGetValueByPage($(obj).attr('data-name'), $(obj).attr('data-value'));
    
    return false;
}

function changeGetValueByPage(name, value) {
    var data = {};

    var link = location.href;

    var purl = parse_url(link);

    if (purl && purl['query']) {
        var pstr = parse_str(purl['query']);

        if (pstr[name]) {
            delete pstr[name];
        }

        for (var i in pstr) {
            if (pstr[i] != '')
                data[i] = pstr[i];
        }
    }

    if (value != '')
        data[name] = encodeURIComponent(value.replace(/[!'()*]/g, escape));

    var query = http_build_query(data);
    
    link = link.replace(/\?.*$/, '');
    link = link.replace(/#.*$/, '');

    if (query) {
        link += '?' + query;
    }

    if (location.href != link) {
        //alert(link);

        location.href = link;
    }
}

function parse_str(str, array){	// Parses the string into variables
	// 
	// +   original by: Cagri Ekin
	// +   improved by: Michael White (http://crestidg.com)

	var glue1 = '=';
	var glue2 = '&';

	var array2 = str.split(glue2);
	var array3 = [];
	for(var x=0; x<array2.length; x++){
		var tmp = array2[x].split(glue1);
		array3[unescape(tmp[0])] = unescape(tmp[1]).replace(/[+]/g, ' ');
	}

	if(array){
		array = array3;
	} else{
		return array3;
	}
}



var parse_url = function (str, component) {
    // example 1: parse_url('http://username:password@hostname/path?arg=value#anchor');
    // returns 1: {scheme: 'http', host: 'hostname', user: 'username', pass: 'password', path: '/path', query: 'arg=value', fragment: 'anchor'}

    var query, key = [
            'source', 'scheme', 'authority', 'userInfo',
            'user', 'pass', 'host', 'port', 'relative', 'path',
            'directory', 'file', 'query', 'fragment'
        ],
        ini = (this.php_js && this.php_js.ini) || {},
        mode = (ini['phpjs.parse_url.mode'] &&
            ini['phpjs.parse_url.mode'].local_value) || 'php',
        parser = {
            php: /^(?:([^:\/?#]+):)?(?:\/\/()(?:(?:()(?:([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?()(?:(()(?:(?:[^?#\/]*\/)*)()(?:[^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
            strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
            loose: /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/\/?)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/ // Added one optional slash to post-scheme to catch file:/// (should restrict this)
        };

    var m = parser[mode].exec(str),
        uri = {},
        i = 14;
    while (i--) {
        if (m[i]) {
            uri[key[i]] = m[i];
        }
    }

    if (component) {
        return uri[component.replace('PHP_URL_', '').toLowerCase()];
    }
    if (mode !== 'php') {
        var name = (ini['phpjs.parse_url.queryKey'] &&
            ini['phpjs.parse_url.queryKey'].local_value) || 'queryKey';
        parser = /(?:^|&)([^&=]*)=?([^&]*)/g;
        uri[name] = {};
        query = uri[key[12]] || '';
        query.replace(parser, function ($0, $1, $2) {
            if ($1) {
                uri[name][$1] = $2;
            }
        });
    }
    delete uri.source;
    return uri;
}

var http_build_query = function (obj, num_prefix, temp_key) {

    var output_string = []

    Object.keys(obj).forEach(function (val) {

        var key = val;

        num_prefix && !isNaN(key) ? key = num_prefix + key : ''

        var key = encodeURIComponent(key.replace(/[!'()*]/g, escape));
        temp_key ? key = temp_key + '[' + key + ']' : ''

        if (typeof obj[val] === 'object') {
            var query = http_build_query(obj[val], null, key)
            output_string.push(query)
        } else {
            var value = String(obj[val]);

            value = encodeURIComponent(value.replace(/[!'()*]/g, escape));

            output_string.push(key + '=' + value)
        }

    })

    return output_string.join('&')

}
</script>
@endpush