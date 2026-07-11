<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate_{{ $certificate->certificate_number ?? 'Download' }}</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        body {
            font-family: Georgia, "Times New Roman", serif;
            color: #171717;
            background-color: #ffffff;
            margin: 0;
            padding: 30px;
            -webkit-print-color-adjust: exact;
        }
        .cert-container {
            border: 6px double #064e3b; /* border-emerald-800 */
            padding: 40px 30px;
            position: relative;
            text-align: center;
            outline: 2px solid #d4a017;
            outline-offset: -12px;
            min-height: 480px;
            background-color: #ffffff;
        }
        /* Structural Corner Accents */
        .corner {
            position: absolute;
            width: 20px;
            height: 20px;
        }
        .top-left     { top: 8px; left: 8px; border-top: 2px solid #d4a017; border-left: 2px solid #d4a017; }
        .top-right    { top: 8px; right: 8px; border-top: 2px solid #d4a017; border-right: 2px solid #d4a017; }
        .bottom-left  { bottom: 8px; left: 8px; border-bottom: 2px solid #d4a017; border-left: 2px solid #d4a017; }
        .bottom-right { bottom: 8px; right: 8px; border-bottom: 2px solid #d4a017; border-right: 2px solid #d4a017; }

        /* Typography & Layout Spacers */
        .logo-fallback {
            font-size: 28px;
            font-weight: 900;
            font-style: italic;
            color: #064e3b;
            line-height: 1;
            margin-bottom: 5px;
        }
        .logo-fallback span {
            font-size: 16px;
            font-style: normal;
            display: block;
            color: #d97706; /* text-amber-600 */
            margin-top: 2px;
        }
        .school-name {
            font-size: 18px;
            font-weight: 900;
            color: #064e3b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2px;
        }
        .accreditation {
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #737373;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: bold;
            margin-bottom: 12px;
        }
        .gradient-line {
            height: 2px;
            background: #047857; /* Fallback flat emerald line for dompdf rendering */
            margin: 15px auto;
            width: 80%;
        }
        .cert-title {
            font-size: 32px;
            font-weight: 900;
            letter-spacing: 6px;
            color: #064e3b;
            margin-top: 15px;
            margin-bottom: 2px;
        }
        .cert-subtitle {
            font-family: Arial, sans-serif;
            font-size: 11px;
            letter-spacing: 4px;
            color: #a3a3a3;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .certify-text {
            font-size: 12px;
            color: #737373;
            font-style: italic;
            margin-bottom: 12px;
        }
        .student-name {
            font-size: 22px;
            font-weight: 900;
            color: #0a0a0a;
            letter-spacing: 1px;
            border-bottom: 2px solid #064e3b;
            display: inline-block;
            padding: 2px 30px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        .description-block {
            font-size: 12px;
            color: #404040;
            max-width: 580px;
            margin: 0 auto;
            line-height: 1.6;
        }
        .license-class {
            font-size: 14px;
            font-weight: bold;
            color: #064e3b;
            display: block;
            margin: 4px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .meta-details {
            margin-top: 15px;
            font-size: 11px;
            color: #525252;
        }
        .cert-no {
            font-family: monospace;
            font-size: 10px;
            color: #a3a3a3;
            margin-top: 4px;
        }
        .divider {
            height: 1px;
            background: #e5e5e5;
            margin: 15px auto;
            width: 70%;
        }

        /* Dompdf Safe Table Grid Layout */
        .footer-table {
            width: 100%;
            margin-top: 25px;
            border-collapse: collapse;
        }
        .footer-table td {
            width: 33.33%;
            vertical-align: bottom;
            text-align: center;
        }
        .signature-line {
            border-top: 1px solid #a3a3a3;
            width: 150px;
            margin: 0 auto;
            padding-top: 4px;
        }
        .signer-title {
            font-size: 11px;
            font-weight: bold;
            color: #171717;
            text-transform: uppercase;
        }
        .signer-subtext {
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #737373;
            font-style: italic;
        }
        .footer-date {
            font-size: 10px;
            color: #525252;
            padding-bottom: 5px;
        }
        .legal-notice {
            margin-top: 25px;
            font-family: Arial, sans-serif;
            font-size: 9px;
            color: #a3a3a3;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="cert-container">
    <div class="corner top-left"></div>
    <div class="corner top-right"></div>
    <div class="corner bottom-left"></div>
    <div class="corner bottom-right"></div>

    @if(isset($schoolLogoUrl) && $schoolLogoUrl)
        <img src="{{ $schoolLogoUrl }}" style="height: 60px; margin: 0 auto 8px auto;" alt="Logo">
    @else
        <div class="logo-fallback">
            AF
            <span>Al-Fawzan</span>
        </div>
    @endif

    <div class="school-name">{{ $schoolName ?? 'Al-Fawzan Driving School' }}</div>
    <div class="accreditation">FRSC &amp; KASTLEA Accredited Institution</div>

    <div class="gradient-line"></div>

    <div class="cert-title">CERTIFICATE</div>
    <div class="cert-subtitle">of completion</div>

    <div class="certify-text">THIS IS TO CERTIFY THAT</div>

    <div class="student-name">
        {{ $certificate->user->name ?? $studentName ?? 'STUDENT FULL NAME' }}
    </div>

    <div class="description-block">
        has successfully completed the required professional driving training programme in
        <span class="license-class">
            {{ $certificate->license_class_label ?? 'Class E Certificate' }}
        </span>
        at {{ $schoolName ?? 'Al-Fawzan Driving School' }} and is hereby certified as a competent driver in complete accordance with Federal Road Safety Corps (FRSC) and KASTLEA operational framework standards.
    </div>

    <div class="meta-details">
        @if(isset($certificate->completed_at))
            <div>Training completed: <strong>{{ \Carbon\Carbon::parse($certificate->completed_at)->format('d M, Y') }}</strong></div>
        @endif
        @if(isset($certificate->certificate_number))
            <div class="cert-no">Certificate No: <strong>{{ $certificate->certificate_number }}</strong></div>
        @endif
    </div>

    <div class="divider"></div>

    <table class="footer-table">
        <tr>
            <td>
                @if(isset($signatureUrl) && $signatureUrl)
                    <img src="{{ $signatureUrl }}" style="height: 35px; margin: 0 auto 2px auto;" alt="Signature">
                @endif
                <div class="signature-line">
                    <div class="signer-title">{{ $certificate->instructor_name ?? 'Instructor' }}</div>
                    <div class="signer-subtext">Instructor in Charge</div>
                </div>
            </td>

            <td>
                <div class="footer-date">
                    Date Issued: <strong>{{ isset($certificate->issued_at) ? \Carbon\Carbon::parse($certificate->issued_at)->format('d M, Y') : now()->format('d M, Y') }}</strong>
                </div>
            </td>

            <td>
                <div class="signature-line" style="margin-top: 37px;">
                    <div class="signer-title">{{ $certificate->director_name ?? 'Director' }}</div>
                    <div class="signer-subtext">Director / Principal</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="legal-notice">
        This document is officially issued under statutory provisions of {{ $schoolName ?? 'Al-Fawzan Driving School' }}.
    </div>
</div>

</body>
</html>