# X3P0: Media Data

![Mostly decorative banner that displays a screenshot of the Media Data block in action and Nova, the brand's mascot, in a city holding a camera.](/.wporg/banner-1544x500.jpg)

Display image, audio, and video metadata fields—EXIF, ID3, and more—right inside the WordPress block editor, instantly and flexibly.

Your photos, songs, and videos hold more information than you might think—camera settings, recording details, dimensions, and more. WordPress quietly saves all of that data when you upload a file but doesn't make it easy to showcase it. **X3P0: Media Data changes that.**

Media Data introduces powerful yet simple blocks for showing metadata from any WordPress media file. Whether you're a photographer displaying EXIF details, a podcaster highlighting episode metadata, or an archivist cataloging digital assets, this plugin brings your media's data to the forefront—right from the block editor.

## Usage

The plugin comes with two blocks out of the box:

- **`Media Data`:** A container block for assigning a media ID and wrapping Media Data Field blocks.
- **`Media Data Field`:** A block that displays a particular piece of data or metadata about the media. This block has a nearly two dozen variations.

To use the blocks, you must first add the Media Data block to the editor. From there, you can **Upload** a new media file or select from your existing **Media Library**. Once selected, a few Media Data Fields (those common to all media types) will automatically populate the Media Data container.

From there, you can select a different field type via the **Field** option in the sidebar. Or you can add any of the variations available for the type of data you want to show. Feel free to mix and match at your leisure.

You can also change a field's label directly from the content canvas in the editor or via the **Label** option in the sidebar.

## Developers

### Block Bindings Support

With WordPress 6.9+, the Media Data block supports Block Bindings on its `mediaID` attribute. This means that you can feed it any media attachment ID in WordPress and have it automatically output the data (very useful for things like attachment templates!).

The following is an example of using a custom source to connect an ID to the `mediaID` attribute. Just replace `your-namespace/your-source` with your binding source and configure any `args` necessary for it.

```html
<!-- wp:x3p0/media-data {
	"metadata":{
		"bindings":{
			"mediaId":{
				"source":"your-namespace/your-source",
				"args":{"key":"id"}
			}
		}
	}
} -->
<div class="wp-block-x3p0-media-data">
	<!-- wp:x3p0/media-data-field {"field":"dimensions"} /-->
	<!-- wp:x3p0/media-data-field {"field":"created_timestamp"} /-->
	<!-- wp:x3p0/media-data-field {"field":"camera"} /-->
	<!-- wp:x3p0/media-data-field {"field":"aperture"} /-->
	<!-- ... -->
</div>
<!-- /wp:x3p0/media-data -->
```

### Developing Media Data

This plugin requires composer, so if you're Git cloning the repository, you must run these two commands in your command line program to get up and running:

```bash
composer install
composer build
```

See the `composer.json` file for available commands.

If you plan on editing the scripts or styles, you'll also need to run:

```bash
npm install
npm build
```

See the `package.json` file for available commands.

## License

X3P0: Media Data is licensed under the GPL version 3.0 or later.

The project includes resources from [Material Icons](https://fonts.google.com/icons), which are licensed under [Apache 2.0](http://www.apache.org/licenses/LICENSE-2.0.txt).
