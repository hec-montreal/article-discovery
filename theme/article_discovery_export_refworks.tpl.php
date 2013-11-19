<?php
/**
 * @file
 * Formats $data as Refworks Tagged Format (RTF).
 *
 * @param $data
 *   $data is an associative array containing metadata to be re-encoded as RTF
 *
 */


$rtmap = array(
  'no-such-entity'                => 'Abstract',
  'Art'                           => 'Artwork',
  'Graphic Art'                   => 'Artwork',
  'Image'                         => 'Artwork',
  'Online Image'                  => 'Artwork',
  'Painting'                      => 'Artwork',
  'Photograph'                    => 'Artwork',
  'no-such-entity'                => 'Bills/Resolutions',
  'Book Chapter'                  => 'Book, Section',
  'no-such-entity'                => 'Book, Edited',
  'Book'                          => 'Book, Whole',
  'eBook'                         => 'Book, Whole',
  'Case'                          => 'Case/Court Decisions',
  'Computer File'                 => 'Computer Program',
  'Electronic Resource'           => 'Computer Program',
  'Software'                      => 'Computer Program',
  'Conference Proceeding'         => 'Conference Proceedings',
  'Dissertation'                  => 'Dissertation/Thesis',
  'Online Dissertation'           => 'Dissertation/Thesis',
  'no-such-entity'                => 'Dissertation/Thesis, Unpublished',
  'Architectural Drawing'         => 'Generic',
  'Archival Material'             => 'Generic',
  'Archival Material/Manuscripts' => 'Generic',
  'Blueprints'                    => 'Generic',
  'Book Review'                   => 'Generic',
  'Catalog'                       => 'Generic',
  'Ceremonial Object'             => 'Generic',
  'Clothing'                      => 'Generic',
  'Course Reading'                => 'Generic',
  'Data Set'                      => 'Generic',
  'Drawing'                       => 'Generic',
  'Equipment'                     => 'Generic',
  'Exam'                          => 'Generic',
  'Furnishing'                    => 'Generic',
  'Government Document'           => 'Generic',
  'Houseware'                     => 'Generic',
  'Ignored'                       => 'Generic',
  'Implements'                    => 'Generic',
  'Kit'                           => 'Generic',
  'Learning Object'               => 'Generic',
  'Manuscript'                    => 'Generic',
  'Microfilm'                     => 'Generic',
  'Microform'                     => 'Generic',
  'Mixed'                         => 'Generic',
  'Model'                         => 'Generic',
  'Musical Instrument'            => 'Generic',
  'Newsletter'                    => 'Generic',
  'Online Archival Material'      => 'Generic',
  'Pamphlet'                      => 'Generic',
  'Paper'                         => 'Generic',
  'Personal Article'              => 'Generic',
  'Play'                          => 'Generic',
  'Poem'                          => 'Generic',
  'Postcard'                      => 'Generic',
  'Poster'                        => 'Generic',
  'Presentation'                  => 'Generic',
  'Publication'                   => 'Generic',
  'Publication Article'           => 'Generic',
  'Realia'                        => 'Generic',
  'Research Publication'          => 'Generic',
  'Serial'                        => 'Generic',
  'Sheet Music'                   => 'Generic',
  'Slide'                         => 'Generic',
  'Special Collection'            => 'Generic',
  'Standard'                      => 'Generic',
  'Tool'                          => 'Generic',
  'Transcript'                    => 'Generic',
  'Unknown'                       => 'Generic',
  'no-such-entity'                => 'Grant',
  'no-such-entity'                => 'Hearing',
  'Article'                       => 'Journal Article',
  'Journal Article'               => 'Journal Article',
  'Journal'                       => 'Journal, Electronic',
  'Trade Publication Article'     => 'Journal Article',
  'Trade Publication'             => 'Journal, Electronic',
  'eJournal'                      => 'Journal, Electronic',
  'no-such-entity'                => 'Laws/Statutes',
  'Magazine'                      => 'Magazine Article',
  'Magazine Article'              => 'Magazine Article',
  'Atlas'                         => 'Map',
  'Globe'                         => 'Map',
  'Map'                           => 'Map',
  'Maps and Atlases'              => 'Map',
  'no-such-entity'                => 'Monograph',
  'Film'                          => 'Motion Picture',
  'Filmstrip'                     => 'Motion Picture',
  'Music Score'                   => 'Music Score',
  'Online Music Score'            => 'Music Score',
  'Newspaper'                     => 'Newspaper Article',
  'Newspaper Article'             => 'Newspaper Article',
  'no-such-entity'                => 'Online Discussion Forum',
  'Patent'                        => 'Patent',
  'no-such-entity'                => 'Personal Communication',
  'Report'                        => 'Report',
  'Album'                         => 'Sound Recording',
  'Audio Book on CD'              => 'Sound Recording',
  'Audio Book on Casette'         => 'Sound Recording',
  'Audio Recording'               => 'Sound Recording',
  'Audio Tape'                    => 'Sound Recording',
  'Compact Disc'                  => 'Sound Recording',
  'Music'                         => 'Sound Recording',
  'Music CD'                      => 'Sound Recording',
  'Music LP'                      => 'Sound Recording',
  'Music Manuscript'              => 'Sound Recording',
  'Music Recording'               => 'Sound Recording',
  'Online Audio Recording'        => 'Sound Recording',
  'Sound Recording'               => 'Sound Recording',
  'Spoken Word Recording'         => 'Sound Recording',
  'no-such-entity'                => 'Unpublished Material',
  'Online Video Recording'        => 'Video/ DVD',
  'Video Casette'                 => 'Video/ DVD',
  'Video DVD'                     => 'Video/ DVD',
  'Video Recording'               => 'Video/ DVD',
  'Web Resource'                  => 'Web Page',
);
$fields = array(
   'T1' => 'Title',
   'A1' => 'Author',
   'ID' => 'ID',
   'JF' => 'PublicationTitle',
   'VO' => 'Volume',
   'IS' => 'Issue',
   'SP' => 'StartPage',
   'K1' => array('Keywords', 'SubjectTerms'),
   'CL' => 'ClassificationCodes',
   'AB' => 'Abstract',
   'YR' => 'PublicationYear',
   'NO' => 'Notes',
   'ED' => 'Edition',
   'OP' => 'PageNote',
   'PB' => 'Publisher',
   'PP' => 'PublicationPlace',
   'SN' => array('ISSN', 'ISBN', 'EISSN', 'EISBN'),
   'LA' => 'Language',
   'DO' => 'DOI',
   'CN' => array('DEWEY', 'LCCallNum'),
   'DB' => 'DatabaseTitle',
   'UL' => 'URI',
   'PMID' => 'PMID',
//   'PMCID' => 'PCID',
   'CR' => 'References',
);
?>
<?php if (is_array($data)): ?>
<?php foreach ($data as $record) {
        if (isset($record->Author_xml) && count($record->Author_xml)) {
          $record->Author = array();
          foreach ($record->Author_xml as $author_object) {
            $record->Author[] = $author_object->fullname;
          }
        }
?>
RT <?php print $rtmap[$record->ContentType[0]]; ?>

<?php
  foreach ($fields as $tag => $summon) {
    if (!is_array($summon)) {
      $summon = array($summon);
    }
    foreach ($summon as $summon_field) {
      if (isset($record->$summon_field) && is_array($record->$summon_field) && count($record->$summon_field)) {
        foreach ($record->$summon_field as $value) {
          foreach (explode("\n", $value) as $line) {
            printf("%s %s\n", $tag, $line);
          }
        }
      }
    }
  }
?>

<?php } ?>
<?php endif;
