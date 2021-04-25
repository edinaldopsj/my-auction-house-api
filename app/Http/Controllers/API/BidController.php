<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BidResource;
use App\Models\Bid;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BidController extends Controller
{
    /**
     * Display a listing of all bids.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bids = Bid::where('item_id', $request->header('item_id'))->orderByDesc('created_at')->get();

        return response([
            'bids' => BidResource::collection($bids),
            'message' => 'Retrieved successfully'
        ], 200);
    }

    /**
     * Store a newly created bid in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['item_id'] = $request->header('item_id');
        $data['bidder_id'] = $request->header('bidder_id');
        $data['bidded_at'] = Carbon::now();

        $validator = Validator::make($data, [
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $item = Item::find($data['item_id']);

        if ($data['amount'] <= $item->price) {
            return response(['message' => 'Please bid a higher value then the initial price'], 403);
        }

        $latestBid = Bid::select('amount')->where('item_id', $data['item_id'])->orderByDesc('created_at',)->limit(1)->first();

        if ($data['amount'] <= $latestBid->amount) {
            return response(['message' => 'Please bid a higher value then the latest bid'], 403);
        }

        $bid = Bid::create($data);

        return response([
            'bid' => new BidResource($bid),
            'message' => 'Created successfully'
        ], 201);
    }

    /**
     * Display the specified bid.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        return response(['bid' => new BidResource($bid), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified bid in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        return response(['message' => 'Not allowed'], 403);
    }

    /**
     * Remove the specified bid from storage.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        return response(['message' => 'Not allowed'], 403);
    }
}
