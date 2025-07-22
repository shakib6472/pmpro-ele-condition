# PMPro ELE Condition

**Contributors:** shakib6472  
**Tags:** pmpro, paid membership pro, elementor, conditional visibility, membership levels  
**Requires at least:** 5.2  
**Tested up to:** 6.8  
**Stable tag:** 1.0.0  
**Requires PHP:** 7.2  
**License:** GPLv2 or later  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html

Add conditional visibility to Elementor widgets based on Paid Memberships Pro membership levels. Show/hide content for specific members.

## Description

PMPro ELE Condition seamlessly integrates Paid Memberships Pro with Elementor to provide powerful membership-based conditional visibility controls. This plugin allows you to show or hide any Elementor widget, column, or container based on the user's PMPro membership level using server-side PHP processing for optimal performance and security.

### Key Features

* **Complete Elementor Integration**: Works with widgets, columns, and containers
* **Server-Side Processing**: Elements are removed before rendering for better performance
* **Flexible Show/Hide Logic**: Choose to show OR hide elements for selected membership levels
* **Multiple Level Selection**: Target multiple membership levels simultaneously
* **Guest User Support**: Handle non-logged-in users and non-members
* **Body Class Integration**: Automatically adds membership level classes for styling
* **No Content Leakage**: Hidden content is completely removed from the DOM

### Supported User States

* **Guest Users**: Visitors who are not logged in
* **Non-Members**: Logged-in users without active memberships
* **Active Members**: Users with specific PMPro membership levels

### How It Works

The plugin adds conditional visibility controls directly to Elementor's Advanced tab. When a page loads:

1. The plugin checks the user's membership status
2. Compares it against the element's visibility settings
3. Removes non-matching elements from the HTML before rendering
4. Adds appropriate body classes for additional styling options

This server-side approach ensures hidden content never reaches the browser, providing better security and performance.

## Installation

### From WordPress Admin

1. Download the plugin zip file
2. Go to your WordPress admin panel
3. Navigate to Plugins > Add New
4. Click "Upload Plugin" 
5. Choose the downloaded zip file and click "Install Now"
6. Activate the plugin

### Manual Installation

1. Upload the `pmpro-ele-condition` folder to `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress

### Requirements

* WordPress 5.2 or higher
* PHP 7.2 or higher
* **Paid Memberships Pro plugin** (active and configured)
* **Elementor plugin** (free or Pro)

## Usage

### Setting Up Conditional Visibility

1. **Edit any page with Elementor**
2. **Select a widget, column, or container**
3. **Go to the Advanced tab**
4. **Find "PMPRO Ele Condition" section**
5. **Toggle "Enable PMPRO Conditional Visibility" to ON**
6. **Choose visibility behavior:**
   - **Show**: Element visible only to selected membership levels
   - **Hide**: Element hidden from selected membership levels
7. **Select target membership levels** (supports multiple selection)
8. **Update/Publish the page**

### Membership Level Options

The plugin automatically detects your PMPro membership levels and provides these options:

* **Not Logged In**: Visitors who haven't logged in
* **Non Members**: Logged-in users without memberships
* **[Your Membership Levels]**: All configured PMPro levels

### Body Classes for Styling

The plugin adds CSS classes to the `<body>` element:

* `pmpro-level-guest`: Not logged in
* `pmpro-level-none`: Logged in, no membership  
* `pmpro-level-{level-name}`: Active membership (sanitized level name)

**Example:** "Premium Package" becomes `pmpro-level-premium-package`

## Advanced Usage

### Multiple Level Targeting

You can select multiple membership levels for a single element:

- **Show to "Basic" AND "Premium"**: Element appears for both levels
- **Hide from "Free" AND "Guest"**: Element hidden from both states

### Practical Use Cases

* **Premium Content Blocks**: Show advanced features only to paid members
* **Upgrade Prompts**: Display upgrade messages only to free users
* **Member-Specific CTAs**: Different call-to-action buttons per membership level
* **Tiered Content**: Progressive content revelation based on membership tier

## Frequently Asked Questions

### Does this work with Elementor Pro?

Yes, the plugin works with both free Elementor and Elementor Pro versions.

### Can I target multiple membership levels?

Absolutely! The membership level selector supports multiple selections.

### What happens if PMPro is deactivated?

The plugin requires PMPro to function properly. Without it, membership detection won't work.

### Does this affect page performance?

No, the server-side processing actually improves performance by removing elements before they reach the browser.

### Can I use this with any PMPro membership level?

Yes, the plugin automatically detects all your configured PMPro membership levels.

### Is the hidden content secure?

Yes, hidden elements are completely removed from the HTML before sending to the browser, ensuring content security.

## Screenshots

1. **Conditional Visibility Controls** - The PMPro ELE Condition section in Elementor's Advanced tab
2. **Membership Level Selection** - Multiple membership levels selection interface
3. **Show/Hide Toggle** - Simple switch to control visibility behavior
4. **Body Classes** - Automatically generated CSS classes for additional styling

## Changelog

### 1.0.0
* Initial release
* Server-side conditional visibility for Elementor elements
* Integration with Paid Memberships Pro membership levels
* Support for widgets, columns, and containers
* Automatic body class generation for membership levels
* Multiple membership level targeting
* Show/Hide logic for flexible content control

## Support

For support, feature requests, or bug reports:

* **GitHub Repository**: https://github.com/shakib6472/
* **Plugin URI**: https://github.com/shakib6472/

## Contributing

Contributions are welcome! Please submit pull requests or open issues on GitHub.

## License

This plugin is licensed under GPL v2 or later.

## Credits

**Developed by Shakib Shown**

* GitHub: https://github.com/shakib6472/
* Requires: Paid Memberships Pro & Elementor

