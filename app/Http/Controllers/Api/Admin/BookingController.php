<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminApproveBookingRequest;
use App\Http\Requests\FilterBookingIndexRequest;
use App\Http\Resources\AdminIndexBookingsResource;
use App\Http\Resources\AdminShowApprovedBookingResource;
use App\Models\Booking;
use App\Repositories\BookingRepository;
use App\Services\Booking\Admin\BookingApproveService;
use App\Services\Booking\Admin\BookingReadService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function index(FilterBookingIndexRequest $request, BookingReadService $bookingReadService)
    {
        $bookings = $bookingReadService->read($request->validated());

        return AdminIndexBookingsResource::collection($bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function approveBooking(AdminApproveBookingRequest $request, Booking $booking, BookingApproveService $bookingApproveService){

        $bookingApproved = $bookingApproveService->approvedBooking($booking);

        return response()->json([
            'message' => 'Booking Approved Succefully.',
            'booking' => new AdminShowApprovedBookingResource($bookingApproved),
        ], 201);
    }

}
