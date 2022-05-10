<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Undangan kegiatan - {{ $participant->name }}</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('vendor/dashlite-v2/css/dashlite.min.css') }}"/>
    <style>
      @media print {
        #print {
          display: none;
        }
      }

      body::after {
          content: 'UNDANGAN';
          display: block;
          position: absolute;
          top: 18.75rem;
          font-family: Nunito,sans-serif;
          left: 46rem;
          opacity: .1;
          transform: rotate(-40deg);
          font-size: 5rem;
      }
    </style>
</head>

<body class="nk-body bg-white npc-default has-aside ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container wide-xl">
                        <div class="nk-content-inner">

                            <div class="nk-content-body">
                                <div class="nk-content-wrap">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                                <h3 class="nk-block-title page-title">Undangan Kegiatan</h3>
                                                <div class="nk-block-des text-soft">
                                                    <ul class="list-inline">
                                                        <li>Dibuat pada <span class="text-base">
                                                          {{ $schedule->created_at->locale('id-ID')->isoFormat('LLLL') }}
                                                        </span></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="invoice">
                                            <!-- <div class="invoice-action">
                                                <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="#" id="print" target="_blank"><em class="icon ni ni-printer-fill"></em></a>
                                            </div> -->
                                            <div class="invoice-wrap">
                                                <div class="invoice-head">
                                                    <div class="invoice-contact">
                                                        <span class="overline-title">Ditunjukan kepada</span>
                                                        <div class="invoice-contact-info">
                                                            <h4 class="title">Tamu Sipil</h4>
                                                            <ul class="list-plain">
                                                                <li>{{ $participant->name }} - {{ $participant->phone_number }}</li>
                                                                <li><span>{{ $participant->email }}</span></li>
                                                                <li><span>Nama tokoh: {{ $participant->origin ?: 'Tidak disertakan' }}</span></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div><!-- .invoice-head -->
                                                <div class="invoice-bills mt-3">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Ruangan</th>
                                                                    <th>Nama kegiatan</th>
                                                                    <th>Deskrpsi</th>
                                                                    <th>Dari</th>
                                                                    <th>Waktu mulai/akhir</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>{{ strtoupper($schedule->room->name)  }}</td>
                                                                    <td>
                                                                      {{ $schedule->title }}
                                                                    </td>
                                                                    <td>
                                                                      {{ $schedule->desc }}
                                                                    </td>
                                                                    @if ($schedule->user?->origin()->count() > 0)
                                                                    <td>{{ strtoupper($schedule->user->origin->title) }}</td>
                                                                    @else

                                                                    <td>{{ strtoupper($schedule->user->name) }}</td>
                                                                    @endif
                                                                    <td>
                                                                      {{ $schedule->started_at->isoFormat('LLL') }} <b>-</b> {{ $schedule->ended_at->isoFormat('LLL') }}

                                                                    </td>

                                                                </tr>

                                                            </tbody>
                                                            <tfoot>
                                                                <tr>

                                                                    <td class="py-5" colspan="3"> </td>

                                                                    <td class="py-5">
                                                                      <p>Scan QRCODE untuk mendaftar kegiatan</p>
                                                                      {!! QrCode::size(130)->format('svg')->style('round')->generate(
                                                                          route('qrcode.scanner', $schedule->id, $participant->id)
                                                                      ); !!}
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <div class="nk-notes ff-italic fs-12px text-soft"> Catatan: Undangan dapat dicetak untuk Absesni pada saat mengikuti kegiatan </div>


                                                    </div>
                                                </div><!-- .invoice-bills -->
                                            </div><!-- .invoice-wrap -->
                                        </div><!-- .invoice -->

                                        <div class="row mt-4">
                                            <div class="col-sm-12 col-md-4">
                                                <p class="fw-bold">Berikut unggahan yang dilampirkan</p>
                                                <ul class="list-group">
                                                    @foreach ($schedule->attachments as $attachment)
                                                    <li class="list-group-item">
                                                        <a href="{{ asset('storage/'.$attachment->path) }}" target="__blank" class="fw-medium d-block">{{ $attachment->original_filename }}</a>
                                                        <span>{{ ceil($attachment->size / 1024) }}kb</span>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block -->
                                </div>
                                <!-- footer @s -->
                                `
                                <!-- footer @e -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script>
      document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('print').addEventListener('click', () => {
          window.print();
        })
      });
    </script>
</body>

</html>