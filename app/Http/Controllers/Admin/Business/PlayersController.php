<?php

namespace App\Http\Controllers\Admin\Business;

use \Exception;

use App\Criteria\Player\ComposedSearchCriteria;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Player\DataRequest;

use App\Models\Player;

use App\Repositories\Contracts\PlayerRepository;

use App\Services\Player\PlayerService;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PlayersController extends Controller
{
    /**
     * Constructor
     *
     * @param  PlayerRepository  $playerRepository
     * @param  PlayerService     $playerService
     */
    public function __construct(
        PlayerRepository $playerRepository,
        PlayerService $playerService
    )
    {
        $this->playerRepository = $playerRepository;

        $this->playerService = $playerService;
    }

    /**
     * Show the players page.
     *
     * @param  Request  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->playerRepository->pushCriteria(app(ComposedSearchCriteria::class));

        $players = $this->playerRepository->orderBy('id', 'desc')->paginate(50);

        if ($request->ajax()) {
            return response()->json($players);
        }

        return view('front.templates.admin.business.players.index', compact('players'));
    }

    /**
     * Show the players create page.
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.templates.admin.business.players.create');
    }

    /**
     * Show the players edit page.
     *
     * @param  Player  $player
     *
     * @return  Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $data = compact('player');

        return view('front.templates.admin.business.players.edit', $data);
    }

    /**
     * Stores a new record.
     *
     * @param  DataRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function store(DataRequest $request)
    {
        try {
            $player = $this->playerService->create($request);

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.players.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.players.index'),
        ]);
    }

    /**
     * Updates player.
     *
     * @param  Player     $player
     * @param  DataRequest  $request
     *
     * @return  Illuminate\Http\Response
     */
    public function update(Player $player, DataRequest $request)
    {
        try {
            $player = $this->playerService->update($player, $request);

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.players.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.players.index'),
        ]);
    }

    /**
     * Destroy player.
     *
     * @param  Player  $player
     *
     * @return  Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        try {
            $this->playerRepository->delete($player->id);

            flash(trans('messages.success'), 'success');

            return response()->json([
                'success'  => true,
                'redirect' => route('admin.players.index'),
            ]);

        } catch (Exception $e) {
            Log::error($e);

            flash(trans('messages.exception'), 'danger');
        }

        return response()->json([
            'success'  => false,
            'redirect' => route('admin.players.index'),
        ]);
    }
}
