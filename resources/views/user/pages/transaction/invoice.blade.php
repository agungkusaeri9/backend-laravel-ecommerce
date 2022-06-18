<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>{{ $title }}</title>

		<style>
			.invoice-box {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				padding: 5px;
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.top table td.title {
				font-size: 45px;
				line-height: 45px;
				color: #333;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 40px;
			}

			.invoice-box table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 20px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			/** RTL **/
			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
		</style>
	</head>

	<body onload="window.print()">
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="4">
						<table>
							<tr>
								<td class="title">
									<img src="{{ $store->logo() }}" style="width: 100%; max-width: 300px;max-height:150px" />
								</td>

								<td>
									Invoice: #{{ $item->id }}<br />
									Created: {{ $item->created_at->translatedFormat('l, d F Y') }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
                <tr class="information">
					<td colspan="4">
						<table>
							<tr>
								<td style="width: 300px">
									{{ $store->name }}<br />
									<span>{{ $store->address }}</span>
								</td>

								<td>
									{{ $item->user->name }}<br />
									{{ $item->user->address ?? '-' }}<br />
									{{ $item->user->email }}
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr class="heading">
					<td>Product Name</td>
                    <td style="text-align: left">Amount</td>
					<td>Quantity</td>
                    <td>Price Total</td>
				</tr>

				@foreach ($item->details as $detail)
                <tr class="item">
					<td>{{ $detail->product->name }}</td>
                    <td style="text-align: left">{{ $detail->amount }}</td>
					<td style="text-align: right">{{ number_format($detail->product->price) }}</td>
                    <td style="text-align: right">{{ number_format($detail->product->price*$detail->amount) }}</td>
				</tr>
                @endforeach
			</table>
            <div style="display:flex;justify-content:space-between;margin-top:20px">
                <span>Sub Total</span>
                <span>Rp. {{ number_format($item->transaction_total-$item->shipping_cost) }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:5px">
                <span>Shipping Cost</span>
                <span>Rp. {{ number_format($item->shipping_cost) }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:5px">
                <span style="font-weight: 800">Total</span>
                <span>Rp. {{ number_format($item->transaction_total) }}</span>
            </div>

            <div style="display:flex;justify-content:space-between;margin-top:40px">
                <span style="font-weight: 400">Payment Method</span>
                <span style="margin-left:40px">{{ $item->payment->name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between">
                <span style="font-weight: 400">Payment Number</span>
                <span style="margin-left:40px">{{ $item->payment->number }}</span>
            </div>
            <div style="display:flex;justify-content:space-between">
                <span style="font-weight: 400">Payment Description</span>
                <span style="margin-left:40px">{{ $item->payment->desc }}</span>
            </div>
		</div>
	</body>
</html>
