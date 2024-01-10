<?php

namespace App\Services;

use Illuminate\Http\Response;
use Spatie\Browsershot\Browsershot;

class PdfWrapper
{
    protected Browsershot $pdfGenerator;

    protected string $html;

    protected string $headerHtml;

    protected string $footerHtml;

    public function __construct()
    {
        $this->pdfGenerator = new Browsershot();

        $this->headerHtml =  view('pdfs._header')->render();
        $this->footerHtml =  view('pdfs._footer')->render();
    }

    public function loadView(string $bladeFile, array $data = []): self
    {
        $this->html = view($bladeFile, $data)->render();

        return $this;
    }

    public function loadHtml(string $html): self
    {
        $this->html = $html;

        return $this;
    }

    public function loadHeaderHtml(string $headerHtml): self
    {
        $this->headerHtml = $headerHtml;

        return $this;
    }

    public function loadFooterHtml(string $footerHtml): self
    {
        $this->footerHtml = $footerHtml;

        return $this;
    }

    public function generate(): Browsershot
    {
        return $this->pdfGenerator
        ->html($this->html)
        ->setIncludePath(config('services.browsershort.include_path'))
        ->margins(30, 15, 30, 15)
        ->showBrowserHeaderAndFooter()
        ->headerHtml($this->headerHtml)
        ->footerHtml($this->footerHtml)
        ->waitUntilNetworkIdle();
    }

    public function save(string $path): void
    {
        $this->generate()->savePdf($path);
    }

    public function download(string $filename)
    {
        $pdf = $this->generate()->pdf();

        return new Response($pdf, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
            'Content-Length' => strlen($pdf)
        ]);
    }

    public function stream(string $filename)
    {
        return new Response($this->generate()->pdf(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
}
