# X3P0: Media Data

![Mostly decorative banner that displays a screenshot of the Media Data block in action and Nova, the brand's mascot, in a city holding a camera.](/.wporg/banner-1544x500.jpg)

Did you know that WordPress stores data, such as EXIF and ID3 tags, from the media that you upload? It does this very well, but WordPress itself has never had easy ways of obtaining and displaying that data. That's where the **Media Data** plugin comes in.

Media Data is a plugin that registers two blocks for displaying your media data right from the block editor. It supports image, audio, video, and all other media types allowed by WordPress.

## Usage

The plugin comes with two blocks out of the box:

- **`Media Data`:** A container block for assigning a media ID and wrapping Media Data Field blocks.
- **`Media Data Field`:** A block that displays a particular piece of data or metadata about the media. This block has a nearly two dozen variations.

To use the blocks, you must first add the Media Data block to the editor. From there, you can **Upload** a new media file or select from your existing **Media Library**. Once selected, a few Media Data Fields (those common to all media types) will automatically populate the Media Data container.

From there, you can select a different field type via the **Field** option in the sidebar. Or you can add any of the variations available for the type of data you want to show. Feel free to mix and match at your leisure.

You can also change a field's label directly from the content canvas in the editor or via the **Label** option in the sidebar.

## Development

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
