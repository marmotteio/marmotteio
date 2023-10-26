# Security Policy for Marmotte

Your assistance in discovering and addressing vulnerabilities in Marmotte is highly appreciated. We are committed to working with the community to verify and respond to these reports in a timely manner. Here's what you need to know about our security policies and procedures.

## Reporting Security Issues

Please **DO NOT** report security vulnerabilities through public GitHub issues.

Instead, please report them to us by email at `hello@marmotte.io`.

In your report, please include:

- Description of the vulnerability
- Potential impact of the vulnerability
- Your contact information
- Any potential solutions you can think of

The Marmotte security team will acknowledge your email within 48 hours, and you'll receive a more detailed response to your email within 96 hours indicating the next steps in handling your report.

## Security Update Process

Once we've received a vulnerability report, the process we follow is as follows:

1. Confirm the problem: We will acknowledge your report and assign it to a primary handler who will reproduce the issue and confirm its existence.

2. Classify the problem: We will determine the severity of the vulnerability.

3. Fix the problem: The handler will collaborate with the rest of the team to develop a fix.

4. Apply the fix: The fix will be applied to the main branch and backported to all supported versions. New releases for all supported versions will be prepared.

5. Announce the problem: We will make a public announcement detailing the vulnerability and the steps users should take to secure their systems. This announcement will come at least a week after the patch is released to give system administrators an adequate amount of time to patch their systems.

## Supported Versions

Security updates will be applied to the following versions of Marmotte:

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |
| < 1.0   | :x:                |

We will only provide security updates for the latest version of Marmotte. Users are encouraged to upgrade to the latest version as soon as it is available.

## Disclosure Policy

When we receive a security bug report, we will assign it to a primary handler. This person will coordinate the fix and release process. The role of the primary handler is to confirm or deny the problem and then respond to the reporter.

Here are the steps we'll follow:

- Confirm the problem and determine the affected versions.
- Audit code to find any potential similar problems.
- Prepare fixes for all releases which are still under maintenance. These fixes will be deployed as fast as possible to all customers and users.

We will not disclose the problem until it has been resolved in order to protect our users. We will work with you to ensure we fully understand the issue and address it thoroughly.

## Comments on this Policy

If you have any suggestions to improve this policy, please send us an email at `hello@marmotte.io`.

We're immensely grateful for your effort in securing our community. Thanks for your help.
