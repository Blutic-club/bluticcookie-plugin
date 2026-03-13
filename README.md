# Blutic Cookie Consent Plugin for Joomla

A Joomla system plugin that integrates the Blutic Cookie Consent Banner into your Joomla website using your unique Domain ID.

## Description

This plugin automatically adds the Blutic Cookie Consent Banner to your Joomla site's frontend pages. The banner helps you comply with privacy regulations like DPDPA by managing user cookie consent preferences.

## Requirements

- A valid Blutic Domain ID (provided by Blutic)

## Installation

### Install from URL

1. Log in to your Joomla Administrator panel

2. Navigate to **Extensions → Manage → Install**

3. Click on the **Install from URL** tab

4. Enter the following URL in the **Install from URL** field:

   ```
   https://github.com/Blutic-club/bluticcookie-plugin/archive/refs/tags/v2.0.0.zip
   ```

5. Click **Check and Install**

6. Wait for the installation to complete

## Configuration

1. Navigate to **Extensions → Plugins**

2. Search for **System - Blutic Cookie Consent**

3. Click on the plugin name to open settings

4. Configure the following options:
   - **Enable Plugin**: Set to "Yes" to activate the plugin
   - **Domain ID**: Enter your unique Domain ID provided by Blutic Cookie Manager

5. Click **Save & Close**

## Usage

Once configured, the Blutic Cookie Consent Banner will automatically appear on all frontend pages of your Joomla site. The banner will:

- Display cookie consent options to visitors
- Manage user consent preferences
- Publish events of user cookie preference
- Store consent records as per privacy regulations

## Getting Your Domain ID

To use this plugin, you need a Domain ID from Blutic:

1. Visit [Blutic Cookie Manager](https://blutic.club)
2. Sign up or log in to your account
3. Copy your unique Domain ID
4. Enter it in the plugin configuration

## Support

For issues, questions, or feature requests:

- **GitHub Issues**: [https://github.com/Blutic-club/bluticcookie-plugin/issues](https://github.com/Blutic-club/bluticcookie-plugin/issues)
- **Email**: support@blutic.com
- **Website**: [https://blutic.club](https://blutic.club)

## License

This plugin is licensed under the **GPL v2 or later**.

## Credits

**Author**: Blutic Team
**Copyright**: © 2026 Blutic Team. All rights reserved.

## Changelog

### Version 2.0.0

- Initial stable release
- Automated cookie consent banner integration
- Domain ID configuration
- Frontend-only script injection
- Security enhancements and input sanitization
