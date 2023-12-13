<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {

        $members = Member::all();

        return view('dashboard.member.index', [
            'members' => $members,
        ]);
    }

    public function store(Request $request)
    {
        $memberExis = Member::where('kode_member', '=', $request->kode)->first();

        if ($memberExis) {
            return redirect()->route('member.index')->with('error', 'Member (' . $request->nama . ') sudah ada.');
        } else {
            Member::create([
                'kode_member'     => $request->kode,
                'nama'     => $request->nama,
                'alamat'     => $request->alamat,
                'telepon'     => $request->telepon,
            ]);
        }

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambah.');
    }

    public function update(Request $request, Member $member)
    {
        
        $member->update([
            'kode_member'     => $request->kode,
            'nama'     => $request->nama,
            'alamat'     => $request->alamat,
            'telepon'     => $request->telepon,
        ]);

        return redirect()->route('member.index')->with(['success' => 'Member berhasil diubah.']);
    }

    public function destroy(Member $member)
    {
        Member::destroy($member->id);

        return redirect()->back()->with('success', 'Member berhasil dihapus.');
    }
}
