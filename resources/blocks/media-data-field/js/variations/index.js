import { __ } from '@wordpress/i18n';
import { icons } from "./icons";

const variations = [
	{
		name: 'album',
		title: __('Album', 'x3p0-media-data'),
		description: __('Displays the audio album.', 'x3p0-media-data')
	},
	{
		name: 'aperture',
		title: __('Aperture', 'x3p0-media-data'),
		description: __('Displays the camera aperture (f-stop).', 'x3p0-media-data')
	},
	{
		name: 'artist',
		title: __('Artist', 'x3p0-media-data'),
		description: __('Displays the audio artist.', 'x3p0-media-data')
	},
	{
		name: 'aspect_ratio',
		title: __('Aspect Ratio', 'x3p0-media-data'),
		description: __('Displays the media aspect ratio.', 'x3p0-media-data')
	},
	{
		name: 'camera',
		title: __('Camera', 'x3p0-media-data'),
		description: __('Displays the camera model.', 'x3p0-media-data')
	},
	{
		name: 'created_timestamp',
		title: __('Created', 'x3p0-media-data'),
		description: __('Displays when the media was created.', 'x3p0-media-data'),
		icon: icons.year
	},
	{
		name: 'dimensions',
		title: __('Dimensions', 'x3p0-media-data'),
		description: __('Displays the media dimensions (width × height).', 'x3p0-media-data')
	},
	{
		name: 'display_orientation',
		title: __('Display Orientation', 'x3p0-media-data'),
		description: __('Displays the media display orientation.', 'x3p0-media-data')
	},
	{
		name: 'file_name',
		title: __('File Name', 'x3p0-media-data'),
		description: __('Displays the media file name.', 'x3p0-media-data')
	},
	{
		name: 'file_size',
		title: __('File Size', 'x3p0-media-data'),
		description: __('Displays the media file size.', 'x3p0-media-data')
	},
	{
		name: 'focal_length',
		title: __('Focal length', 'x3p0-media-data'),
		description: __('Displays the camera focal length.', 'x3p0-media-data')
	},
	{
		name: 'genre',
		title: __('Genre', 'x3p0-media-data'),
		description: __('Displays the media genre.', 'x3p0-media-data')
	},
	{
		name: 'length_formatted',
		title: __('Duration', 'x3p0-media-data'),
		description: __('Displays the media length/duration.', 'x3p0-media-data')
	},
	{
		name: 'iso',
		title: __('ISO', 'x3p0-media-data'),
		description: __('Displays the image ISO', 'x3p0-media-data')
	},
	{
		name: 'mime_type',
		title: __('MIME Type', 'x3p0-media-data'),
		description: __('Displays the media MIME type.', 'x3p0-media-data')
	},
	{
		name: 'orientation',
		title: __('Orientation', 'x3p0-media-data'),
		description: __('Displays the media EXIF orientation.', 'x3p0-media-data')
	},
	{
		name: 'shutter_speed',
		title: __('Shutter Speed', 'x3p0-media-data'),
		description: __('Displays the camera shutter speed.', 'x3p0-media-data')
	},
	{
		name: 'title',
		title: __('Title', 'x3p0-media-data'),
		description: __('Displays the media title.', 'x3p0-media-data'),
		isDefault: true
	},
	{
		name: 'track_number',
		title: __('Track Number', 'x3p0-media-data'),
		description: __('Displays the audio track number.', 'x3p0-media-data')
	},
	{
		name: 'year',
		title: __('Year', 'x3p0-media-data'),
		description: __('Displays the media published year.', 'x3p0-media-data')
	}
];

export default variations.map(variation => ({
	icon: icons?.[variation.name] || null,
	attributes: { field: variation.name },
	scope: ['inserter', 'transform'],
	isActive: ['field'],
	...variation
}));
